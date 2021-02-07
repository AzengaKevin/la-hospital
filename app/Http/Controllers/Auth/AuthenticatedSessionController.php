<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Registration view for both patients and doctors
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Delete the current authenticated session and logout the user
     */
    public function destroy()
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route(RouteServiceProvider::HOME));
    }
}
