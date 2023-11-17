<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\Comment\CommentCreateRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('frontend.products.index');
    }

    public function show($level1, $level2 = null, $level3 = null)
    {

        $category = Category::whereSlug( $level1)->firstOrFail();
        $categories = Category::whereNull('parent_category_id')->get();
        if(isset($level3)){

            $category           = Category::whereSlug($level1)->firstOrFail();
            $sub_category       = Category::whereSlug($level2)->firstOrFail();
            $product_details    = Product::where('sub_category_id', $sub_category->id)->where('category_id', $category->id)->whereSlug($level3)->firstOrFail();
            $related_products   = Product::where('sub_category_id', $sub_category->id)->where('category_id', $category->id)->where('slug', '!=', $level3)->limit(5)->get();
            $comments_count     = Comment::whereSlug($level3)->get();
            $heart_count        = WishList::where('product_id',$product_details->id)->get();

            if ($product_details)
            {
                return view('frontend.products.show',compact(['product_details','sub_category' ,'category','related_products','comments_count','heart_count'] ));
            }
            else{
                return view('frontend.products.show',compact(['product_details','sub_category' ,'category','related_products','comments_count','heart_count'] ));
            }
        }

        if(isset($level2)){
            $category = Category::whereSlug($level1)->firstOrFail();
            $sub_category = Category::whereSlug($level2)->firstOrFail();
            $products = Product::where('sub_category_id', $sub_category->id)
                ->where('category_id', $category->id)
                ->paginate(2);

            $products_for_banner = Product::all();

            if (count($products)>0)
            {
                return view('frontend.products.index',compact(['products','sub_category' ,'category','categories','products_for_banner'] ));
            }
            else{
                return view('frontend.products.index',compact(['products','sub_category' ,'category','categories','products_for_banner'] ));
            }
        }
        if (isset($level1)){

            $products = Product::where('category_id', $category->id)->paginate(2);

            $category = Category::whereSlug($level1)->firstOrFail();

            $products_for_banner = Product::all();

            if (count($products)>0)
            {
                return view('frontend.products.all_products',compact(['products' ,'category','categories','products_for_banner'] ));
            }
            else{
                return view('frontend.products.all_products',compact(['products' ,'category','categories','products_for_banner'] ));
            }
        }

    }
    public function product_comment(CommentCreateRequest $request)
    {
        $comment = Comment::create($request->validated());
        return response()->json([
            'status' => 200,
            'comment' => $comment,
        ]);
    }
    public function getComments(Request $request)
    {
        $slug = $request->input('slug');
        $comments = Comment::whereSlug($slug)->get();

        return response()->json([
            'status' => 200,
            'comments' => $comments,
        ]);
    }
    public function product_range(Request $request)
    {

        $from = $request->input('from');
        $to = $request->input('to');
        $product_sub_category_id = $request->input('product_sub_category_id');
        $product_category_id = $request->input('product_category_id');
        $sub_category_name =Category::whereId($product_sub_category_id)->first();
        $category_name = Category::whereId($product_category_id)->first();
        $products = Product::getByPriceRange($from, $to,$product_sub_category_id)->paginate(2);

        return response()->json([
            'status'=>200,
            'products'=>$products,
            'category_name'=>$category_name,
            'sub_category_name'=>$sub_category_name,
            'lastPage'=>$products->links()->paginator->lastPage(),
        ]);
    }

    public function all_product_range(Request $request)
    {

        $from = $request->input('from');
        $to = $request->input('to');
        $product_category_id = $request->input('product_category_id');
        $category_name = Category::whereId($product_category_id)->first();
        $products = Product::getByPriceRangeAllProduct($from, $to,$product_category_id)->paginate(2);

        return response()->json([
            'status'=>200,
            'products'=>$products,
            'category_name'=>$category_name->slug,
            'lastPage'=>$products->links()->paginator->lastPage(),
        ]);
    }

    public function sort(Request $request){
        $sortOption = $request->input('sort_option');
        $category_id = $request->input('category_id');
        $sub_category_id = $request->input('sub_category_id');

        $category_name = Category::whereId($category_id)->first();
        $sub_category_name = Category::whereId($sub_category_id)->first();
        $product_is_wish = [];
        // Define the base query
        $query = Product::with('subCategory')->with('category')->where('category_id', $category_id)
            ->where('sub_category_id', $sub_category_id);
        if (auth()->id()){
            foreach ($query as $item) {
                if ($item->userWishList(auth()->id(),$item->id))
                {
                    $product_is_wish[]=($item->id);
                }
            }
        }
        else
        {
            $product_is_wish=[];
        }

        // Apply sorting based on the selected option
        switch ($sortOption) {
            case 'asc':
                $query->orderBy('name', 'asc');
                break;
            case 'dsc':
                $query->orderBy('name', 'desc');
                break;
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-dsc':
                $query->orderBy('price', 'desc');
                break;
            default:
                // Handle default sorting here
        }

        // Paginate the results
        $products = $query->Paginate(2);

        return response()->json([
            'status' => 200,
            'products' => $products,
            'product_is_wish'=>$product_is_wish,

            //this data paginations data

            'category_name'=>$category_name->slug,
            'sub_category_name'=>$sub_category_name->slug,
            'total'=>$products->links()->paginator->total(),
            'lastPage'=>$products->links()->paginator->lastPage(),
            'path'=>$products->links()->paginator->path(),
        ]);
    }

    public function all_sort(Request $request){
        $sortOption = $request->input('sort_option');
        $category_id = $request->input('category_id');


        $category_name = Category::whereId($category_id)->first();

        $product_is_wish = [];
        // Define the base query
        $query = Product::with('subCategory')->with('category')->where('category_id', $category_id);
        if (auth()->id()){
            foreach ($query as $item) {
                if ($item->userWishList(auth()->id(),$item->id))
                {
                    $product_is_wish[]=($item->id);
                }
            }
        }
        else
        {
            $product_is_wish=[];
        }

        // Apply sorting based on the selected option
        switch ($sortOption) {
            case 'asc':
                $query->orderBy('name', 'asc');
                break;
            case 'dsc':
                $query->orderBy('name', 'desc');
                break;
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-dsc':
                $query->orderBy('price', 'desc');
                break;
            default:
                // Handle default sorting here
        }

        // Paginate the results
        $products = $query->Paginate(2);

        return response()->json([
            'status' => 200,
            'products' => $products,
            'product_is_wish'=>$product_is_wish,

            //this data paginations data
            'category_name'=>$category_name->slug,
            'total'=>$products->links()->paginator->total(),
            'lastPage'=>$products->links()->paginator->lastPage(),
            'path'=>$products->links()->paginator->path(),
        ]);
    }
}
