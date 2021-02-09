<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Shows the about page to the user or a guest
     */
    public function about()
    {
        return view('pages.about');
    }


    /**
     * Shows the contact page to the quest or the user
     */
    public function contact()
    {
        return view('pages.contact');
    }
}
