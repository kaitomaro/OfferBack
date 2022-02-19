<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendContactMail;
use App\Mail\ThankForContactMail;
use Illuminate\Support\Facades\Mail;
use App\Contact;

class HomeController extends Controller
{
    public function hp(Request $request) {
        return view('hp.hp');
    }

    public function hp_store(Request $request) {
        return view('hp.store_hp');
    }
    public function about(Request $request) {
        return view('hp.about');
    }

    public function open_app(Request $request, $shop_id) {
        return view('hp.open_app');
    }

    public function contact(Request $request) {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->sentence = $request->content;
        $contact->save();

        Mail::to("contact@eatap.co.jp")
        ->send(new SendContactMail($contact->name, $contact->email, $contact->sentence));

        Mail::to($contact->email)
        ->send(new ThankForContactMail($contact->name, $contact->sentence));

        return redirect('/');
    }
}
