<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::latest()->get();
        
        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Verify doctor
     */
    public function update(Doctor $doctor)
    {
        $doctor->update(['verified' => true]);

        return redirect()->back();
    }
}
