<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Http\Requests\backend\Shipping\ShippingCreateRequest;
use App\Http\Requests\backend\Shipping\ShippingUpdateRequest;

class ShippingController extends Controller
{
    public function index() : View
    {

        $shippings = Shipping::whereNull('parent_shipping_id')->get();
        return view('backend.shipping.index', compact('shippings'));
    }


    public function create(): View
    {
        if (auth('admin')->user()->is_admin>=2){
            return view('backend.shipping.create');
        }
        return redirect()->route('backend.shipping.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }


    public function store(ShippingCreateRequest $request) :RedirectResponse
    {

        if (auth('admin')->user()->is_admin>=2){

            $shipping =Shipping::create([
                'shipping_name' => $request->name,
                'slug'          => Str::slug($request->name),

            ]);
            return redirect()->route('backend.shipping.index')->withSuccess('Yeni kategoriya elave edildi');
        }
        return redirect()->route('backend.shipping.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }


    public function edit(string $slug) : View
    {
        if (auth('admin')->user()->is_admin>=3) {
            $shipping= Shipping::whereSlug($slug)->first();
                return view('backend.shipping.edit', compact('shipping'));
            }
        return redirect()->route('backend.shipping.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }


    public function update(ShippingUpdateRequest $request,string $slug)
    {
        if (auth('admin')->user()->is_admin>=3) {
        $shipping= Shipping::whereSlug( $slug)->first();

        $shipping_update = $shipping->update([
            'shipping_name' => $request->name,
            'slug'          => Str::slug($request->name),
        ]);

        return redirect()->route('backend.shipping.edit',$shipping->slug)->withSuccess('Yenileme ugurla neticelendi');
        }
        return redirect()->route('backend.shipping.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');
    }


    public function destroy(string $slug)
    {
        if (auth('admin')->user()->is_admin>=4) {
            $shipping=Shipping::whereSlug($slug)->first();
            $shipping->delete();
            return redirect()->route('backend.shipping.index')->withSuccess('silinme ugurla neticelendi');
        }
        return redirect()->route('backend.shipping.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }
}
