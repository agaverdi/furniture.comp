<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\SubCategory\SubCategoryCreateRequest;
use App\Http\Requests\backend\SubCategory\SubCategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SubCategoryController extends Controller
{

    public function index() :View
    {

        $all_categories = new Category();
        $all_categories = $all_categories->getCategoriesWithSubcategories();
        return view('backend.sub_category.index', compact('all_categories'));
    }


    public function create() : View
    {
        if (auth('admin')->user()->is_admin>=2){
        $categories = Category::whereNull('parent_category_id')->get();
        return view('backend.sub_category.create', compact('categories'));
        }
        return redirect()->route('backend.category.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }


    public function store(SubCategoryCreateRequest $request) :RedirectResponse
    {
        if (auth('admin')->user()->is_admin>=2){
            $image  = time() . '.' . $request->file('image')->getClientOriginalName();
            $path   = $request->file('image')->move(public_path('frontend/sub_categories/images'), $image);


            $sub_category = Category::create( [
                'category_name'     => $request->name,
                'slug'              => Str::slug($request->name),
                'parent_category_id'=> $request->parent_category_id,
                'is_set'            => $request->is_set,
                'image'             => 'frontend/sub_categories/images/'.$image,
            ]);
            return  redirect()->route('backend.sub_category.index')->withSuccess('ugurla alt kategoriya yaradildi');
        }
        return redirect()->route('backend.category.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }


    public function edit(string $slug) : View
    {
        if (auth('admin')->user()->is_admin>=3) {
            $categories = Category::whereNull('parent_category_id')->get();
            $sub_category= Category::whereNotNull('parent_category_id')->whereSlug( $slug)->first();

            return view('backend.sub_category.edit', compact(['sub_category', 'categories']));
        }
        return redirect()->route('backend.category.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }


    public function update(SubCategoryUpdateRequest $request, $slug)
    {
        if (auth('admin')->user()->is_admin>=3) {
            $sub_category= Category::whereSlug( $slug)->firstOrFail();
            if(isset($request->image))
            {
                $image_name = time() . '.' . $request->file('image')->getClientOriginalName();
                $image = $request->file('image')->move(public_path('frontend/sub_categories/images'), $image_name);
            }
            else
            {
                $image_name = null;
                $image = null;
            }
            $sub_category->update( [
                'category_name'     => $request->name,
                'slug'              => Str::slug($request->name),
                'parent_category_id'=> $request->parent_category_id,
                'is_set'            => $request->is_set,
                'image'             => $image ? 'frontend/sub_categories/images/' . $image_name : $sub_category->image,

            ]);
            return redirect()->route('backend.sub_category.edit', [$sub_category->slug])->withSuccess('Yenileme ugurla neticelendi');
        }
        return redirect()->route('backend.category.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }


    public function destroy(Request $slug)
    {
        if (auth('admin')->user()->is_admin>=4) {
            $sub_category=Category::whereSlug( $slug)->first();
            $sub_category->delete();
            return redirect()->route('backend.sub_category.index')->withSuccess('silinme ugurla neticelendi');
        }
        return redirect()->route('backend.category.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');
    }
}
