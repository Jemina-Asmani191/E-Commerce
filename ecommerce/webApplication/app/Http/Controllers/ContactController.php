<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function create(){
        return view('ecommerce.contact-us');
    }
    public function store(Request $request){
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->back()->with('flash_message_success', 'Your Queries has been submit successfully!!');

        //print_r($request->input());
    }
}
