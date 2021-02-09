<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display all doctors to the user
     */
    public function index()
    {
        $doctors = Doctor::with('user')->paginate();

        return view('doctors.index', compact('doctors'));
    }

    /**
     * Display a single doctor
     */
    public function show(Doctor $doctor)
    {
        $doctor->load('user');

    }

}
