<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

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
     * Logs in the user
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['bail', 'required', 'email'],
            'password' => ['bail', 'required']
        ]);

        if(Auth::attempt($data)){
            $request->session()->regenerate();

            return redirect()->intended(route(RouteServiceProvider::HOME));

        }else{

            return back()->withInput()
                ->withErrors(['email' => 'Invalid user credentials']);
        }
    }

    /**
     * Delete the current authenticated session and logout the user
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route(RouteServiceProvider::HOME));
    }
}