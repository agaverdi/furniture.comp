<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\ContactCreateRequest;
use App\Models\Contact;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index():View
    {

        return view('frontend.contact.contact');
    }

    public function store(ContactCreateRequest $request){

        $contact = Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
        ]);

        return redirect()->route('frontend.contact')->withSuccess('mesajiniz gonderildi. En qisa zamanda emailinize mesaj gonderilecek');
    }
}
