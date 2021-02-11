<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['bail', 'required', 'string', 'max:255'],
            'email' => ['bail', 'required', 'email', 'max:255'],
            'phone' => ['bail', 'required', 'string', 'max:255'],
            'subject' => ['bail', 'required', 'string', 'max:255'],
            'message' => ['bail', 'required', 'string']
        ]);
        
        Contact::create($data);

        //Create a session message
        $request->session()->flash('message', 'Contact Submitted Successfully');

        return redirect()->route('contact');
    }
}
