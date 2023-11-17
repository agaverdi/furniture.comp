<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\SetProduct;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $products       = Product::count();
        $users          = User::count();
        $categories     = Category::whereNull('parent_category_id')->count();
        $subCategories  = Category::whereNotNull('parent_category_id')->count();
        $setProducts    = SetProduct::count();
        $shipping       = Shipping::whereNull('parent_shipping_id')->count();
        $sub_shipping   = Shipping::whereNotNull('parent_shipping_id')->count();
        $contact        = Contact::count();
        return view('backend.dashboard.dashboard',
            compact(
                [
                    'products',
                    'users' ,
                    'categories',
                    'subCategories',
                    'setProducts',
                    'shipping',
                    'sub_shipping',
                    'contact',
                ]));
    }
}
