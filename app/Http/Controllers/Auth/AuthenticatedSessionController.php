<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    /**
     * Registration view for both patients and doctors
     */
    public function create()
    {
        return view('auth.login');
    }
}
