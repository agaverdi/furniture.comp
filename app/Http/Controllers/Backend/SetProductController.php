<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SetProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SetProductController extends Controller
{

    public function index() :View
    {
        $set_products = new SetProduct();
        $set_products = $set_products->getProductsWithSetProduct();

        return view('backend.set_product.index',compact('set_products'));
    }


    public function edit($slug) : View
    {
        if (auth('admin')->user()->is_admin>=3) {
        $set_product = SetProduct::where('set_slug', $slug)->first();
        return view('backend.set_product.edit', compact('set_product'));
        }
        return redirect()->route('backend.set_product.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }


    public function update(Request $request, $slug)
    {
        if (auth('admin')->user()->is_admin>=3) {
        $set_product= SetProduct::where('set_slug', $slug)->firstOrFail();

        $set_product->update( [
            'set_name'      => $request->set_name,
            'set_slug'      => Str::slug($request->set_name),
            'set_price'     => $request->set_price,
            'count'         => $request->count,
            'set_discount'  => $request->set_discount,
        ]);
        return redirect()->route('backend.set_product.edit', [$set_product->set_slug])->withSuccess('Yenileme ugurla neticelendi');
        }
        return redirect()->route('backend.set_product.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }


    public function destroy($id)
    {

    }
}
