<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegistrationController extends Controller
{
    /**
     * Registration view for both patients and doctors
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle Registration request for both patients and doctors
     * 
     * @param Request $request
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'type' => ['bail', 'required', Rule::in(User::types())],
            'user.name' => ['bail', 'required', 'max:255', 'string'],
            'user.email' => ['bail', 'required', 'max:255', 'email', 'unique:users,email'],
            'user.phone' => ['bail', 'required', 'max:32', 'unique:users,phone'],
            'user.gender' => ['bail', 'required', Rule::in(User::genderOptions())],
            'user.password' => ['bail', 'required'],
            'doctor.speciality' => [
                'bail', 
                Rule::in(Doctor::specialityOptions()), 
                Rule::requiredIf($request->type == 'doctor')
            ],

            'patient.dob' => [
                'bail',
                Rule::requiredIf($request->type == 'patient')
            ]
        ]);
        
        //Create the doctor
        $doctor = Doctor::create($data['doctor']);

        //Create the user part of the doctor and authenticate
        Auth::login($user = $doctor->user()->create($data['user']));

        event(new Registered($user));

        return redirect()->route(RouteServiceProvider::HOME);
    }
}
