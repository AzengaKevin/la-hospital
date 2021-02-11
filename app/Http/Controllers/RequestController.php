<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class RequestController extends Controller
{

    public function __construct() {

        $this->middleware('auth');

    }
    /**
     * Show all medical requests from the currently logged in user
     */
    public function index(Request $request)
    {
        $requests = $request->user()->requests;

        return view('requests.index', compact('requests'));
    }

    /**
     * Shows the page for creating a request
     */
    public function create(Request $request)
    {
        $doctors = Doctor::all();

        return view('requests.create', compact('doctors'))->withDoctorId($request->doctor_id);
    }

    /**
     * Creates a request in the database
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'doctor_id' => ['bail', 'required', 'integer'],
            'description' => ['bail', 'required'],
        ]);

        $request->user()->requests()->create($data);

        return redirect()->route('requests.index');
    }

    /**
     * Show the request the user made to a doctor
     */
    public function show(\App\Models\Request $request)
    {
        $request->load('response');

        return view('requests.show', compact('request'));
    }

    /**
     * Displaying the page to edit a request
     */
    public function edit(\App\Models\Request $request)
    {
        $doctors = Doctor::all();

        return view('requests.edit', compact('request', 'doctors'));
    }

    /**
     * Updates fields of an already existing request
     */
    public function update(\App\Models\Request $request)
    {
        $data = request()->validate([
            'doctor_id' => ['bail', 'required', 'integer'],
            'description' => ['bail', 'required'],
        ]);

        $request->update($data);

        return redirect()->route('requests.show', $request);
    }

    /**
     * Delete a request from the database
     */
    public function destroy(\App\Models\Request $request)
    {
        $request->delete();

        return redirect()->route('requests.index');
    }
}
