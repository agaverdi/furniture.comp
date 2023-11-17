<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index():View
    {
        $contacts = Contact::all();

        return view('backend.contact.index', compact('contacts'));
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function destroy(string $id):RedirectResponse
    {
        if (auth('admin')->user()->is_admin>=4) {
            $contact=Contact::whereId( $id)->first();
            $contact->delete();
            return redirect()->route('backend.contact.index')->withSuccess('silinme ugurla neticelendi');
        }
        return redirect()->route('backend.contact.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');
    }
}
