<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\Product\ProductCreateRequest;
use App\Http\Requests\backend\Product\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\SetProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{

    public function index() : View
    {
        $products = Product::getProductsWithCategory();
        return view('backend.product.index', compact('products'));
    }

    public function create() :View
    {
        if (auth('admin')->user()->is_admin>=2){
        $categories = Category::whereNull('parent_category_id')->get();
        return view('backend.product.create', compact('categories'));
        }
        return redirect()->route('backend.product.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }

    public function store(ProductCreateRequest $request) :RedirectResponse
    {
        if (auth('admin')->user()->is_admin>=2){
            //bax burani deyirem biraz yekedi (menimki kimi) bunu nece balacalasdiraq
            //brat product elave edende bir productuin coxlu sekilleri olur he?hee
            //aysagol bunu bele etmede input file multiple ele sekilleri yukle sonrada dd ele goressenki sene array icin onu bilireme mende prosda 6 sekil yukliye biler qoymusam 7 dene yuklese onu soxmaqa yer yoxdu
            //validate elede 7dene yuklsin bir bir almaq menasizdi bu qeder sekili eslinde duz deyirsen onu saxlamisam sonra elemeye burda basqa ne iwler gormey olar balacalawsin
            $image_name1 = time() . '.' . $request->file('path1')->getClientOriginalName();
            $image_name2 = isset($request->path2) ? time() . '.' . $request->file('path2')->getClientOriginalName() : null;
            $image_name3 = isset($request->path3) ? time() . '.' . $request->file('path3')->getClientOriginalName() : null;
            $image_name4 = isset($request->path4) ? time() . '.' . $request->file('path4')->getClientOriginalName() : null;
            $image_name5 = isset($request->path5) ? time() . '.' . $request->file('path5')->getClientOriginalName() : null;
            $image_name6 = isset($request->path6) ? time() . '.' . $request->file('path6')->getClientOriginalName() : null;

            $path1 = $request->file('path1')->move(public_path('backend/products/images'), $image_name1);
            $path2 = isset($request->path2) ? $request->file('path2')->move(public_path('backend/products/images'), $image_name2) : null;
            $path3 = isset($request->path3) ? $request->file('path3')->move(public_path('backend/products/images'), $image_name3) : null;
            $path4 = isset($request->path4) ? $request->file('path4')->move(public_path('backend/products/images'), $image_name4) : null;
            $path5 = isset($request->path5) ? $request->file('path5')->move(public_path('backend/products/images'), $image_name5) : null;
            $path6 = isset($request->path6) ? $request->file('path6')->move(public_path('backend/products/images'), $image_name6) : null;


            $is_set = Category::where('id', '=', $request->sub_category_id)->first();
            $dataCount = 6;
            $total_price = 0;
            $total_disprice = 0;
            if ($is_set->is_set==1){
                for ($i = 1; $i <= $dataCount; $i++) {

                    $set_price = $request->input("set_price$i");
                    $set_discount = $request->input("set_discount$i");
                    $count = $request->input("count$i");

                    $total_count = $set_price * $count;
                    $total_discount = $set_discount *$count;
                    $total_price = $total_price + $total_count;
                    $total_disprice = $total_disprice +$total_discount;

                }
            }
            else{
                $total_price = $request->price;
                $total_disprice = $request->discount;
            }

            $product = Product::create([
                'name'              => $request->name,
                'slug'              => Str::slug($request->name),
                'category_id'       => $request->parent_category_id,
                'sub_category_id'   => $request->sub_category_id,
                'description'       => $request->description,
                'price'             => $total_price,
                'discount_price'    => $total_disprice,
                'stars'             => $request->stars,
                'is_stock'          => $request->is_stock,
                'path1'             => $path1 ? 'backend/products/images/' . $image_name1 : null,
                'path2'             => $path2 ? 'backend/products/images/' . $image_name2 : null,
                'path3'             => $path3 ? 'backend/products/images/' . $image_name3 : null,
                'path4'             => $path4 ? 'backend/products/images/' . $image_name4 : null,
                'path5'             => $path5 ? 'backend/products/images/' . $image_name5 : null,
                'path6'             => $path6 ? 'backend/products/images/' . $image_name6 : null,
            ]);


            //bura uje algoritmi buu istesen private bir funkisyaya ata bilersen
            // hara atiram private functionu yeni hardan cagiriram
            if ($is_set->is_set==1){

                for ($i = 1; $i <= $dataCount; $i++) {
                    $set_name = $request->input("set_name$i");
                    $set_price = $request->input("set_price$i");
                    $set_discount = $request->input("set_discount$i");
                    $count = $request->input("count$i");

                    // Check if all the fields of the set are present
                    if ($set_name && $set_price && $set_discount && $count) {
                        $set_products = SetProduct::create([
                            'set_product_id'=>$product->id,
                            'set_name'=>$set_name,
                            'set_slug'=>Str::slug($set_name),
                            'set_price'=>$set_price,
                            'set_key'=>$i,
                            'set_discount'=>$set_discount,
                            'count'=>$count,
                        ]);
                    }
                }
            }
            $product_details_create = ProductDetails::create([
                'product_id'=>$product->id,
                'slider'=>0,
                'new_items'=>0,
                'hot_sale_items'=>0,
                'feature_items' => 0,
                'discount_items' => 0,
            ]);

            return  redirect()->route('backend.product.index')->withSuccess('ugurla Product yaradildi');
        }
        return redirect()->route('backend.product.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }

    public function edit($slug) : View
    {
        if (auth('admin')->user()->is_admin>=3) {
            $product =Product::whereSlug($slug)->firstOrFail();
            $categories = Category::whereNull('parent_category_id')->get();
            $sub_categories= Category::whereNotNull('parent_category_id')->get();
            $product_details =ProductDetails::where('product_id',$product->id)->firstOrFail();


            return view('backend.product.edit', compact('product','categories','sub_categories','product_details'));
        }
        return redirect()->route('backend.product.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');
    }

    public function update(ProductUpdateRequest $request, string $slug)
    {if (auth('admin')->user()->is_admin>=3) {
        $product= Product::whereSlug($slug)->firstOrFail();
        $product_id = $product->id;

        $image_name1 = isset($request->path1) ? time() . '.' . $request->file('path1')->getClientOriginalName() : null;
        $image_name2 = isset($request->path2) ? time() . '.' . $request->file('path2')->getClientOriginalName() : null;
        $image_name3 = isset($request->path3) ? time() . '.' . $request->file('path3')->getClientOriginalName() : null;
        $image_name4 = isset($request->path4) ? time() . '.' . $request->file('path4')->getClientOriginalName() : null;
        $image_name5 = isset($request->path5) ? time() . '.' . $request->file('path5')->getClientOriginalName() : null;
        $image_name6 = isset($request->path6) ? time() . '.' . $request->file('path6')->getClientOriginalName() : null;

        $path1 = isset($request->path1) ? $request->file('path1')->move(public_path('backend/products/images'), $image_name1) : null;
        $path2 = isset($request->path2) ? $request->file('path2')->move(public_path('backend/products/images'), $image_name2) : null;
        $path3 = isset($request->path3) ? $request->file('path3')->move(public_path('backend/products/images'), $image_name3) : null;
        $path4 = isset($request->path4) ? $request->file('path4')->move(public_path('backend/products/images'), $image_name4) : null;
        $path5 = isset($request->path5) ? $request->file('path5')->move(public_path('backend/products/images'), $image_name5) : null;
        $path6 = isset($request->path6) ? $request->file('path6')->move(public_path('backend/products/images'), $image_name6) : null;


        $is_set = Category::whereId( $request->sub_category_id)->first();

        $dataCount = 6;
        $total_disprice = 0;
        $total_price = 0;

        if (isset($is_set->is_set) && $is_set->is_set==1){
            for ($i = 1; $i <= $dataCount; $i++) {

                $set_price = $request->input("set_price$i");
                $set_discount = $request->input("set_discount$i");
                $count = $request->input("count$i");

                $total_count = $set_price * $count;
                $total_discount = $set_discount *$count;
                $total_price = $total_price + $total_count;
                $total_disprice = $total_disprice +$total_discount;

            }
        }
        else{
            $total_price = $request->price;
            $total_disprice = $request->discount;

        }

        $productUpdate = $product->update([
            'name'              => $request->name,
            'slug'              => Str::slug($request->name),
            'category_id'       => $request->parent_category_id,
            'sub_category_id'   => $request->sub_category_id,
            'description'       => $request->description,
            'price'             => $total_price,
            'discount_price'    => $total_disprice,
            'stars'             => $request->stars,
            'is_stock'          => $request->is_stock,
            'path1'             => $path1 ? 'backend/products/images/' . $image_name1 : $product->path1,
            'path2'             => $path2 ? 'backend/products/images/' . $image_name2 : $product->path2,
            'path3'             => $path3 ? 'backend/products/images/' . $image_name3 : $product->path3,
            'path4'             => $path4 ? 'backend/products/images/' . $image_name4 : $product->path4,
            'path5'             => $path5 ? 'backend/products/images/' . $image_name5 : $product->path5,
            'path6'             => $path6 ? 'backend/products/images/' . $image_name6 : $product->path6,
        ]);
        $is_set = Category::where('id', '=', $request->sub_category_id)->first();
        $product_slug = Product::whereSlug( Str::slug($request->name))->firstOrFail();
        if ($is_set->is_set==1){
            $_set_product_delete = SetProduct::where('set_product_id','=', $product_id)->delete();
            $dataCount = 6;
            for ($i = 1; $i <= $dataCount; $i++) {
                $set_name = $request->input("set_name$i");
                $set_price = $request->input("set_price$i");
                $set_discount = $request->input("set_discount$i");
                $count = $request->input("count$i");

                // Check if all the fields of the set are present
                if ($set_name && $set_price && $set_discount && $count) {


                    $set_products = SetProduct::create([
                        'set_product_id'=>$product_id,
                        'set_name'=>$set_name,
                        'set_slug'=>Str::slug($set_name),
                        'set_price'=>$set_price,
                        'set_discount'=>$set_discount,
                        'set_key'=>$i,
                        'count'=>$count,
                    ]);
                }
            }
        }

        $product_details =ProductDetails::where('product_id',$product_id)->firstOrFail();

        $product_details_update = $product_details->update([
            'slider'=>isset($request->sale_product)? 1 :0,
            'new_items'=>isset($request->rated)? 1 :0,
            'hot_sale_items'=>isset($request->hot_sale)? 1 :0,
            'feature_items' => isset($request->featured)? 1 :0,
            'discount_items' => isset($request->best_seller)? 1 :0,
        ]);


        return  redirect()->route('backend.product.edit', $product_slug->slug)->withSuccess('ugurla Product deyistirildi');
        }
        return redirect()->route('backend.product.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }

    public function destroy($slug)
    {
        if (auth('admin')->user()->is_admin>=4) {
        $product = Product::whereSlug( $slug)->first();
        $set_product = SetProduct::where('set_product_id', $product->id);
        $product -> delete();
        $set_product->delete();
        return redirect()->route('backend.product.index')->withSuccess('silinme ugurla neticelendi');
        }
        return redirect()->route('backend.product.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }

    public function sub_category(Request $request)
    {

        $value = $request->input('value');

        $sub_category = Category::where('parent_category_id', $value)->get();
        echo json_encode(array('status' => 200,
            'sub_category' => $sub_category,
        ));
    }

    public function set_product(Request $request)
    {

        $value = $request->input('value');

        $set_product = Category::where('id', $value)->get();
        echo json_encode(array('status' => 200,
            'set_product' => $set_product,
        ));
    }

}
