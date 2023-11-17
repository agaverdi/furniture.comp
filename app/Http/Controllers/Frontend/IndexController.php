<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{

    public function __invoke(): View
    {
        $categories =Category::whereNotNull('parent_category_id')->limit(3)->get();
        $products = Product::all();

        $leastExpensiveProduct = $products->sortBy('price')->first();

        $leastExpensiveHotSaleProduct = $products
            ->filter(function ($product) {
                return $product->product_details->contains('new_items', 1);
            })
            ->sortBy('price')
            ->first();

        $leastExpensiveFeatureProduct = $products
            ->filter(function ($product) {
                return $product->product_details->contains('feature_items', 1);
            })
            ->sortBy('price')
            ->first();

        $leastExpensiveDiscountProduct = $products
            ->filter(function ($product) {
                return $product->product_details->contains('discount_items', 1);
            })

            ->first();

        $hotSaleProducts = $products->filter(function ($product) {
            return $product->product_details->contains('hot_sale_items', 1);
        })->take(4);
        $featureProducts = $products->filter(function ($product) {
            return $product->product_details->contains('feature_items', 1);
        })->take(4);
        $sliderProducts = $products->filter(function ($product) {
            return $product->product_details->contains('slider', 1);
        })->take(4);
        $discountProducts = $products->filter(function ($product) {
            return $product->product_details->contains('discount_items', 1);
        })->take(4);

        return view('frontend.home.home',
            compact('categories',
            'products',
            'hotSaleProducts',
            'featureProducts',
            'sliderProducts',
            'discountProducts',

            'leastExpensiveProduct',
            'leastExpensiveHotSaleProduct',
            'leastExpensiveFeatureProduct',
            'leastExpensiveDiscountProduct',
            ));
    }

    public function searchView(Request $request):View
    {
        $categories = Category::whereNull('parent_category_id')->get();

        $sub_categories = Category::whereNotNull('parent_category_id')->get();
        $wordToSearch = $request->search;

        $search_products = Product::where('name', 'like', '%' . $wordToSearch . '%')
            ->orWhere('description', 'like', '%' . $wordToSearch . '%')
            ->orWhere('slug', 'like', '%' . $wordToSearch . '%')
            ->simplePaginate(2);

        $request->flash();

        return view('frontend.search.search',compact('categories','sub_categories','search_products'));
    }

}
