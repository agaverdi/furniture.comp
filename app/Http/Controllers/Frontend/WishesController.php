<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use App\Models\WishList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WishesController extends Controller
{

    public function wish_list():View
    {

        $wishes = WishList::where('user_id','=',auth()->id())->where('active',0)->get();

        return view('frontend.checkout.wish_list',compact('wishes'));
    }

    public function icon_change(Request $request): JsonResponse
    {
        $user_id = $request->input('userId');
        $product_id = $request->input('productId');
        $class = $request->input('iconClass');

        $item = WishList::where('user_id', $user_id)->where('product_id', $product_id)->first();

        if ($item) {
            if ($item->active == 1) {
                return response()->json([
                    'status' => 200,
                    'active' => 1,
                    'message' => 'Siz bunu karta elave etmisiniz artiq',
                ]);
            } else {
                $item->delete();
                return response()->json([
                    'status' => 200,
                    'active' => 0,
                    'message' => 'istek siyahisindan silindi',
                ]);
            }
        } else {
            $wish_list = WishList::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'active' => 0,
            ]);

            return response()->json([
                'active' => 0,
                'status' => 200,
                'message' => 'istek siyahisina elave edildi',
            ]);
        }
    }

    public function close_wish(Request $request):JsonResponse
    {

        try {
            $dataProductId = $request->input('dataProductId');
            $dataUserId = $request->input('dataUserId');

            $wishes = WishList::with('wish_product')->where('user_id', $dataUserId)->get();


            // Delete the wish
            WishList::where('product_id', $dataProductId)->where('user_id', $dataUserId)->delete();

            // Retrieve the updated wish list

            return response()->json([
                'status' => 200,
                'wishes' => $wishes,
                'message' => 'Istek siyahisindan silindi',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ]);
        }
    }


    public function getData():array
    {

        $user_wishes = WishList::where('user_id',auth()->id())->where('active',0)->get();

        $data = [
            'user_wishes'=>$user_wishes,

        ];

        return $data;
    }

    public function getData_2():array
    {

        $user_carts = WishList::where('user_id',auth()->id())->where('active',1)->get();


        $total_price = WishList::with('wish_product')
            ->where('user_id', auth()->id())
            ->where('active', 1)
            ->get()
            ->sum(function ($wishlistItem) {
                return $wishlistItem->wish_product->price;
            });

        $data = [
            'user_carts'=>$user_carts,
            'total_price'=>$total_price,
        ];

        return $data;
    }

    public function card_list_add(Request $request):JsonResponse
    {
        $user_id = $request->input('userId');
        $product_id = $request->input('productId');

        if (WishList::where('user_id',$user_id)->where('product_id', $product_id)->where('active',1)->first())
        {
            return response()->json([
                'status'    =>  900,
                'message'   =>  'Bu mehsul artiq karta elave olunub',
            ]);
        }

        if (WishList::where('user_id',$user_id)->where('product_id', $product_id)->first()){
            WishList::where('user_id',$user_id)->where('product_id', $product_id)->update([
                'active' => 1,
            ]);
        }
        else{
            $wish_list = WishList::create([
                'user_id'   =>$user_id,
                'product_id'=> $product_id,
                'active'    =>1,
            ]);
        }

        $wishes_to_cart = WishList::with('wish_product')
            ->where('user_id', auth()->id())
            ->where('active', 1)
            ->get();
        $wishesTotalPrice = $wishes_to_cart->sum(function ($wishlistItem) {
            return $wishlistItem->wish_product->price;
        });
        $wishesTotalDiscount = $wishes_to_cart->sum(function ($wishlistItem) {
            return $wishlistItem->wish_product->discount_price;
        });
        $wishesCount = $wishes_to_cart->count();
        return response()->json([
            'wishesTotalDiscount'=>  $wishesTotalDiscount,
            'wishesTotalPrice'   =>  $wishesTotalPrice,
            'wishes_to_card'     =>  $wishes_to_cart,
            'wishesCount'        =>  $wishesCount,
            'status'             =>  200,
            'message'            =>  'istek siyahisina elave edildi',
        ]);
    }

    public function wish_list_clear(Request $request):JsonResponse
    {
        $user_id = $request->input('userId');
        if (WishList::where('user_id',$user_id)->first()){
            WishList::where('user_id',$user_id)->update([
                'active' => 1,
            ]);
        }
        $wishes = WishList::where('user_id','=',auth()->id())->where('active',0)->get();
        $wishesCount = $wishes->count();

        return response()->json([
            'status'        =>  200,
            'wishesCount'   =>  $wishesCount,
            'message'       =>  'Karta elave edildi',
        ]);
    }

    public function cart_add_wishes_all(Request $request):JsonResponse
    {
        $cart_all_data = [];
        $user_id = $request->input('userId');
        if (WishList::where('user_id',$user_id)->where('active',1)->first()){
            $cart_all_data = WishList::with('wish_product')
                ->where('user_id',$user_id)
                ->where('active',1)
                ->get();
        }

        $wishes = WishList::with('wish_product')
            ->where('user_id', auth()->id())
            ->where('active', 1)
            ->get();

        $wishesTotalPrice = $wishes->sum(function ($wishlistItem) {
            return $wishlistItem->wish_product->price;
        });
        $wishesTotalDiscount = $wishes->sum(function ($wishlistItem) {
            return $wishlistItem->wish_product->discount_price;
        });

        $wishesCount = $wishes->count();

        return response()->json([
            'cart_all_data'         =>  $cart_all_data,
            'wishesTotalDiscount'   =>  $wishesTotalDiscount,
            'wishesTotalPrice'      =>  $wishesTotalPrice,
            'wishesCount'           =>  $wishesCount,
            'status'                =>  200,
            'message'               =>  'Karta elave edildi',
        ]);
    }

    public function cart_add_wishes_all_copy(Request $request):JsonResponse
    {
        $cart_all_data = [];
        $user_id = $request->input('userId');
        if (WishList::where('user_id',$user_id)->where('active',1)->first()){
            $cart_all_data = WishList::with('wish_product')
                ->where('user_id',$user_id)
                ->where('active',1)
                ->get();
        }

        $wishes = WishList::with('wish_product')
            ->where('user_id', auth()->id())
            ->where('active', 1)
            ->get();

        $wishesTotalPrice = $wishes->sum(function ($wishlistItem) {
            return $wishlistItem->wish_product->price;
        });
        $wishesTotalDiscount = $wishes->sum(function ($wishlistItem) {
            return $wishlistItem->wish_product->discount_price;
        });

        $wishesCount = $wishes->count();

        return response()->json([
            'cart_all_data'         =>  $cart_all_data,
            'wishesTotalDiscount'   =>  $wishesTotalDiscount,
            'wishesTotalPrice'      =>  $wishesTotalPrice,
            'wishesCount'           =>  $wishesCount,
            'status'                =>  200,
            'message'               =>  'Karta elave edildi',
        ]);
    }

    public function wish_add_and_delete_single_list(Request $request):JsonResponse
    {
        $user_id = $request->input('userId');
        $wishes = WishList::with('wish_product')
            ->where('user_id', auth()->id())
            ->where('active', 0)
            ->get();

        $wishesCount = $wishes->count();
        if ($wishesCount==0){
            return response()->json([
                'wishes'                =>  $wishes,
                'wishesCount'           =>  $wishesCount,
                'status'                =>  909,
                'message'               =>  'Karta elave edildi',
            ]);
        }
        return response()->json([
            'wishes'                =>  $wishes,
            'wishesCount'           =>  $wishesCount,
            'status'                =>  200,
            'message'               =>  'Karta elave edildi',
        ]);
    }

    public function wishes_delete_single(Request $request):JsonResponse
    {
        $user_id = $request->input('userId');
        $wishes = WishList::with('wish_product')
            ->where('user_id', auth()->id())
            ->where('active', 0)
            ->get();

        $wishesCount = $wishes->count();
        return response()->json([
            'wishes'                =>  $wishes,
            'wishesCount'           =>  $wishesCount,
            'status'                =>  200,
            'message'               =>  'Karta elave edildi',
        ]);
    }

    public function wish_iks(Request $request):JsonResponse
    {
        $user_id = $request->input('userId');
        $product_id = $request->input('productId');

        WishList::where('user_id',$user_id)->where('product_id', $product_id)->where('active',0)->delete();

        $wishes = WishList::where('user_id', auth()->id())
            ->where('active', 0)
            ->get();

        $wishesCount = $wishes->count();

        return response()->json([
            'status'        =>  200,
            'wishesCount'   =>  $wishesCount,
            'message'       =>  'bu mebel istek siyahisindan silindi',
        ]);
    }

    public function card_iks(Request $request):JsonResponse
    {
        $user_id = $request->input('userId');
        $product_id = $request->input('productId');

        WishList::where('user_id',$user_id)->where('product_id', $product_id)->where('active',1)->update([
            'active' => 0,
        ]);
        $wishes = WishList::with('wish_product')
            ->where('user_id', auth()->id())
            ->where('active', 1)
            ->get();

        $wishesTotalPrice = $wishes->sum(function ($wishlistItem) {
            return $wishlistItem->wish_product->price;
        });
        $wishesTotalDiscount = $wishes->sum(function ($wishlistItem) {
            return $wishlistItem->wish_product->discount_price;
        });

        $wishesCount = $wishes->count();

        return response()->json([
            'status'                =>  200,
            'wishesCount'           =>  $wishesCount,
            'wishesTotalDiscount'   =>  $wishesTotalDiscount,
            'wishesTotalPrice'      =>  $wishesTotalPrice,
            'message'               =>  'bu mebel istek siyahisindan silindi',
        ]);
    }

    public function card_iks_checkout(Request $request):JsonResponse
    {
        $user_id = $request->input('userId');
        $product_id = $request->input('productId');

        WishList::where('user_id',$user_id)->where('product_id', $product_id)->where('active',1)->update([
            'active' => 0,
        ]);
        $wishes = WishList::with('wish_product')
            ->where('user_id', auth()->id())
            ->where('active', 1)
            ->get();

        $wishesTotalPrice = $wishes->sum(function ($wishlistItem) {
            return $wishlistItem->wish_product->price;
        });
        $wishesTotalDiscount = $wishes->sum(function ($wishlistItem) {
            return $wishlistItem->wish_product->discount_price;
        });

        $wishesCount = $wishes->count();

        return response()->json([
            'status'                =>  200,
            'wishesCount'           =>  $wishesCount,
            'wishesTotalDiscount'   =>  $wishesTotalDiscount,
            'wishesTotalPrice'      =>  $wishesTotalPrice,
            'message'               =>  'bu mebel istek siyahisindan silindi',
        ]);
    }

    public function card_product_delete(Request $request):JsonResponse
    {
        $user_id = $request->input('userId');
        $product_id = $request->input('productId');

        WishList::where('user_id',$user_id)->where('product_id', $product_id)->where('active',1)->update([
            'active' => 0,
        ]);
        $carts = WishList::with('wish_product')
            ->where('user_id', auth()->id())
            ->where('active', 1)
            ->get();

        $cartsTotalPrice = $carts->sum(function ($wishlistItem) {
            return $wishlistItem->wish_product->price;
        });
        $cartsTotalDiscount = $carts->sum(function ($wishlistItem) {
            return $wishlistItem->wish_product->discount_price;
        });

        $cartsCount = $carts->count();

        return response()->json([
            'status'                =>  200,
            'cartsCount'            =>  $cartsCount,
            'cartsTotalDiscount'    =>  $cartsTotalDiscount,
            'cartsTotalPrice'       =>  $cartsTotalPrice,
            'message'               =>  'bu mebel istek siyahisindan silindi',
        ]);
    }

    public function wish_list_append(Request $request):JsonResponse
    {
        $user_id = $request->input('userId');
        $product_id = $request->input('productId');
        $wishes = WishList::with('wish_product')
            ->where('user_id', auth()->id())
            ->where('active', 0)
            ->get();

        $wishesCount = $wishes->count();
        return response()->json([
            'wishes'                =>  $wishes,
            'wishesCount'           =>  $wishesCount,
            'status'                =>  200,
            'message'               =>  'Karta elave edildi',
        ]);
    }

    public function wish_list_refresh(Request $request):JsonResponse
    {
        $wishes = WishList::with('wish_product')
            ->where('user_id', auth()->id())
            ->where('active', 0)
            ->get();
        $wishesCount = $wishes->count();
        if($wishesCount==0){
            return response()->json([
                'wishes'                =>  $wishes,
                'wishesCount'           =>  $wishesCount,
                'status'                =>  909,
                'message'               =>  'Karta bosdur halhazirda',
            ]);
        }
        return response()->json([
            'wishes'                =>  $wishes,
            'wishesCount'           =>  $wishesCount,
            'status'                =>  200,
            'message'               =>  'Karta elave edildi',
        ]);
    }
}
