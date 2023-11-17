<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\CheckoutMail;
use App\Models\Cart_to_checkout;
use App\Models\Checkout;
use App\Models\Pages;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\WishList;
Use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function shopping_cart():View
    {

        $card_products = WishList::with('wish_product')
            ->where('user_id', auth()->id())
            ->where('active',1)
            ->get();

        $shipping_state = Shipping::where('is_work',1)->whereNull('parent_shipping_id')->get();

        $cardsTotalPrice = $card_products->sum(function ($wishlistItem) {
            return $wishlistItem->wish_product->price;
        });
        $cardsTotalDiscount = $card_products->sum(function ($wishlistItem) {
            return $wishlistItem->wish_product->discount_price;
        });

        $check_cart_to_checkout = Cart_to_checkout::where('user_id', auth()->id())->where('ended',0)->count();

        return view('frontend.checkout.order_shopping_cart',
            compact('card_products',
                'cardsTotalDiscount',
                'cardsTotalPrice','shipping_state','check_cart_to_checkout')
        );
    }

    /*public function checkout():View
    {
        $card_products = Cart_to_checkout::where('user_id', auth()->id())
            ->where('ended',0)
            ->get();

        return view('frontend.checkout.order_checkout',compact('card_products'));
    }*/
    public function tracking():View
    {

        return view('frontend.checkout.order_tracking');
    }
    public function cart_to_checkoutView():View|RedirectResponse
    {
        if (Cart_to_checkout::where('user_id', auth()->id())->where('ended',0)->count()){

            $user = User::whereId(auth()->id())->firstOrFail();
            $user_details = UserDetails::where('user_id',auth()->id())->firstOrFail();

            //products and quantities which user choose
            $products_and_quantities =Cart_to_checkout::where('user_id', auth()->id())->where('ended',0)->get();
            $products_subtotal = Cart_to_checkout::where('user_id', auth()->id())->where('ended',0)->sum('price_and_qty');
            $products_shipping = Cart_to_checkout::where('user_id', auth()->id())->where('ended',0)->first()->sub_shipping_id;
            $products_shipping = Shipping::whereId($products_shipping)->firstOrFail();
            return view('frontend.checkout.order_checkout',compact('products_and_quantities','products_subtotal','products_shipping','user','user_details'));
        }

            return redirect()->route('frontend.user.cart')->withSuccess('sizin hec bir sifaris vermemisiniz. ilk once sifaris ucun mehsullari secin');

    }
    public function cart_to_checkout(Request $request)
    {

        $quantities = $request->input('quantities');

        $sub_shipping_id = $request->input('sub_shipping_id');
        $products_and_quantities = [];

        foreach ($quantities as $productId => $quantity) {
            // Query the database to get the product based on $productId
            $product = WishList::with('wish_product')->where('product_id', $productId)->first();
            $sub_shipping_price = Shipping::whereId($sub_shipping_id)->first();

            if ($product) {
                Cart_to_checkout::create([
                    'user_id' => auth()->id(),
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'sub_shipping_id' => $sub_shipping_id,
                    'price' => $product->wish_product->price,
                    'price_and_qty' => $product->wish_product->price* $quantity,
                    'coupon' => 1,
                    'ended' => 0,
                ]);
            }
        }

        return response()->json([
            'status' => 200,
        ]);
    }

    public function checkout(Request $request){
        $product_ids = $request->product_ids;
        $product_ids_array = explode(',', $product_ids);
        $product_data = [];
        /*$product_total=0;
        for ($i=0;$i<count($product_ids_array);$i++)
        {
            if ($i/2==0){
                $product_price = Product::where('id',$product_ids_array[$i])->first()->price;
                $product_total =$product_total+$product_price*$product_ids_array[$i+1];
            }
        }*/
        //arrayda birinci cut yerde olan ededler id tek yerde olanlar ise sayidir biz burada carti temizleyirik
        for ($i=0;$i<count($product_ids_array);$i++)
        {
            if ($i%2==0)
            {
                $product_price = WishList::where('user_id',auth()->id())->where('product_id',$product_ids_array[$i])->update(['active'=>0]);
                $product = Product::whereId($product_ids_array[$i])->first();
                $product_data['item'][]=$product;
                $product_data['item'][]=$product_ids_array[$i+1];
            }
        }
        //all cart to checkout data ended change 1
        $cart_to_checkout = Cart_to_checkout::where('user_id',auth()->id())->update([
           'ended'=>1,
        ]);
        $product_data['body'][] = 'Sifarisde olan mallar asaqidakilardir';
        $mailData = [
            'title' => 'Furniture shirketi size qaime gonderdi',
            'body' => $product_data
        ];

        $checkout = Checkout::create([
            'user_id'=>Auth::id(),
            'company'=>$request->company,
            'address'=>$request->address,
            'city'=>$request->city,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'order_text'=>$request->order_text,
            'product_ids'=>$request->product_ids,
            'sub_shipping_id'=>$request->sub_shipping_id,
            'total'=>$request->product_total,
            'coupon'=>1,
        ]);

        Mail::to($request->email)->send(new CheckoutMail($mailData));

        return redirect()->route('frontend.user.cart')->withSuccess('sifaris  ugurla verildi. Emailinize baxin');
    }
    public function product_shipping(Request $request):JsonResponse
    {
        $value = $request->input('value');
        $sub_shipping = Shipping::where('parent_shipping_id', $value)->where('is_work',1)->get();
        return response()->json([
            'status'        =>  200,
            'sub_shipping'  =>  $sub_shipping,
        ]);
    }
    public function product_sub_shipping(Request $request): JsonResponse
    {
        $value = $request->input('value');
        $shipping = Shipping::whereId($value)->get();

        if ($shipping->count() == 0) {
            $postal_code = [
                'id' => 0,
                'postal_code' => 'Secin',
            ];
        } else {
            $postal_code = $shipping->firstOrFail();
        }

        return response()->json([
            'status' => 200,
            'postal_code' => $postal_code,
        ]);
    }
    public function product_shipping_price(Request $request): JsonResponse
    {

        $subshipping = $request->input('subshipping');

        $shipping_price =Shipping::whereId($subshipping)->firstOrFail();

        return response()->json([
            'status'=>200,
            'shipping_price'=>$shipping_price,
        ]);
    }
    public function checkout_delete(Request $request): RedirectResponse
    {
        $cart_to_checkout=Cart_to_checkout::where('user_id',auth()->id())->where('ended',0);
        $cart_to_checkout->delete();
        return redirect()->route('frontend.user.cart')->withSuccess('silinme ugurla neticelendi');
    }
    public function checkout_list(Request $request): View
    {
        $checkout_list = Checkout::where('user_id', auth()->id())->get();

        // Prepare an empty array to store product data
        $productData = [];

        foreach ($checkout_list as $item) {
            // Explode the product IDs into an array
            $productIdsArray = explode(',', $item->product_ids);

            // Fetch product data based on the IDs
            $products = Product::whereIn('id', $productIdsArray)->get();

            // Store the product data along with other checkout data
            $item->productData = $products;

            // Append to the main array
            $productData[] = $item;
        }
        return view('frontend.checkout.checkout_list',compact('productData'));
    }


}
