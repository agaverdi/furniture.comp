<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class FooterController extends Controller
{
    public function getData()
    {

        $categories = Category::whereNull('parent_category_id')->get();
        $sub_categories = Category::whereNotNull('parent_category_id')->get();

        $category_sub_category = [
            'categories' => $categories,
            'sub_categories' => $sub_categories,
        ];

        return $category_sub_category;
    }
}
