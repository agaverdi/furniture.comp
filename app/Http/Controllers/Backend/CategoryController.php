<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\Category\CategoryCreateRequest;
use App\Http\Requests\backend\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{

    public function index() : View
    {

        $categories = Category::whereNull('parent_category_id')->get();
        return view('backend.category.index', compact('categories'));
    }


    public function create(): View|RedirectResponse
    {
        if (auth('admin')->user()->is_admin>=2){
            return view('backend.category.create');
        }
        return redirect()->route('backend.category.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');
    }


    public function store(CategoryCreateRequest $request) :RedirectResponse
    {

        if (auth('admin')->user()->is_admin>=2) {
            $image = time() . '.' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->move(public_path('frontend/categories/images'), $image);

            $category = Category::create([
                'category_name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => 'frontend/categories/images/' . $image,
            ]);
            return redirect()->route('backend.category.index')->withSuccess('Yeni kategoriya elave edildi');
        }
        return redirect()->route('backend.category.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }


    public function edit(string $slug) : View|RedirectResponse
    {
        if (auth('admin')->user()->is_admin>=3) {
            $category = Category::whereSlug($slug)->first();

            return view('backend.category.edit', compact('category'));
        }
        return redirect()->route('backend.category.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');
    }


    public function update(CategoryUpdateRequest $request,string $slug)
    {
        if (auth('admin')->user()->is_admin>=3) {
            $category= Category::whereSlug( $slug)->first();
            if(isset($request->image))
            {
                $image_name = time() . '.' . $request->file('image')->getClientOriginalName();
                $image = $request->file('image')->move(public_path('frontend/categories/images'), $image_name);
            }
            else
            {
                $image_name = null;
                $image = null;
            }

            $category_update = $category->update([
                'category_name' => $request->name,
                'slug'          => Str::slug($request->name),
                'image'         => $image ? 'frontend/categories/images/' . $image_name : $category->image,
            ]);

            return redirect()->route('backend.category.edit',$category->slug)->withSuccess('Yenileme ugurla neticelendi');
        }
        return redirect()->route('backend.category.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');
    }


    public function destroy(string $slug)
    {
        if (auth('admin')->user()->is_admin>=4) {
            $category = Category::whereSlug($slug)->first();
            $category->delete();
            return redirect()->route('backend.category.index')->withSuccess('silinme ugurla neticelendi');
        }
        return redirect()->route('backend.category.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');
    }
}
