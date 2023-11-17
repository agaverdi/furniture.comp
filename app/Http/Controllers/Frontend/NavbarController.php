<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Permissions;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    public function getData()
    {

        $categories = Category::WhereNull('parent_category_id')->get();
        $sub_categories = Category::whereNotNull('parent_category_id');

        $data = [
            'categories'=>$categories,
            'sub_categories' =>$sub_categories,
        ];

        return $data;
    }

    public function getPosition()
    {
        $user = User::whereId(auth('admin')->id())->first();
        $data = [
            'is_admin'=>$user->is_admin
        ];
        return $data;
    }
}
