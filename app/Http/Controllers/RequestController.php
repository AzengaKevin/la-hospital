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
}
