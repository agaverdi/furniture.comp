<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\backend\SubShipping\SubShippingCreateRequest;
use App\Http\Requests\backend\SubShipping\SubShippingUpdateRequest;
use App\Models\Shipping;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SubShippingController extends Controller
{
    public function index() :View
    {

        $all_shippings = new Shipping();
        $all_shippings = $all_shippings->getShippingsWithSubshippings();
        return view('backend.sub_shipping.index', compact('all_shippings'));
    }


    public function create() : View
    {
        if (auth('admin')->user()->is_admin>=2){
        $shippings = Shipping::whereNull('parent_shipping_id')->get();
        return view('backend.sub_shipping.create', compact('shippings'));
        }
        return redirect()->route('backend.sub_shipping.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }


    public function store(SubShippingCreateRequest $request) :RedirectResponse
    {

        if (auth('admin')->user()->is_admin>=2){
        $sub_shipping = Shipping::create( [
            'shipping_name'     => $request->name,
            'slug'              => Str::slug($request->name),
            'parent_shipping_id'=> $request->parent_shipping_id,
            'is_work'           => $request->is_work,
            'postal_code'       => $request->postal_code,
            'shipping_price'    => $request->shipping_price,
        ]);
        return  redirect()->route('backend.sub_shipping.index')->withSuccess('ugurla seher yaradildi');
        }
        return redirect()->route('backend.sub_shipping.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');
    }


    public function edit(string $slug) : View
    {
        if (auth('admin')->user()->is_admin>=3) {
        $shippings = Shipping::whereNull('parent_shipping_id')->get();
        $sub_shipping= Shipping::whereNotNull('parent_shipping_id')->whereSlug( $slug)->first();

        return view('backend.sub_shipping.edit', compact(['sub_shipping', 'shippings']));

        }
        return redirect()->route('backend.sub_shipping.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');
    }


    public function update(SubShippingUpdateRequest $request, $slug)
    {

        if (auth('admin')->user()->is_admin>=3) {
        $sub_shipping= Shipping::whereSlug( $slug)->firstOrFail();

        $sub_shipping->update( [
            'shipping_name'     => $request->name,
            'slug'              => Str::slug($request->name),
            'parent_shipping_id'=> $request->parent_shipping_id,
            'is_work'           => $request->is_work,
            'postal_code'       => $request->postal_code,
            'shipping_price'    => $request->shipping_price,
        ]);
        return redirect()->route('backend.sub_shipping.edit', [$sub_shipping->slug])->withSuccess('Yenileme ugurla neticelendi');

        }
        return redirect()->route('backend.sub_shipping.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');
    }


    public function destroy($slug)
    {
        if (auth('admin')->user()->is_admin>=4) {
        $sub_shipping=Shipping::whereSlug($slug)->first();
        $sub_shipping->delete();
        return redirect()->route('backend.sub_shipping.index')->withSuccess('silinme ugurla neticelendi');
        }
        return redirect()->route('backend.sub_shipping.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }
}
