<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class RequestResponseController extends Controller
{
    /**
     * Show all responses to this particular request
     */
    public function index(\App\Models\Request $request)
    {
        $request->load('response');

        return view('doctor.responses.index', compact('request'));

    }

    /**
     * Store A new Request Response
     */
    public function store(\App\Models\Request $request)
    {        
        $data = request()->validate([
            'type' => ['bail', 'required', Rule::in(Response::types())],
            'description' => ['bail', 'required'],
            'appointment' => ['bail', 'array', Rule::requiredIf($request->type == 'Appointment')],
            'appointment.address' => ['bail', 'nullable', 'max:64' , Rule::requiredIf($request->type == 'Appointment')],
            'appointment.date' => ['bail', 'nullable', Rule::requiredIf($request->type == 'Appointment')],
            'appointment.time' => ['bail', 'nullable', 'string', Rule::requiredIf($request->type == 'Appointment')],
            'appointment.subject' => ['bail', 'nullable', 'string', 'max:64', Rule::requiredIf($request->type == 'Appointment')],
            'appointment.cost' => ['bail', 'nullable', 'numeric', Rule::requiredIf($request->type == 'Appointment')],
            'prescription' => ['bail', 'nullable', 'nullable', 'array', Rule::requiredIf($request->type == 'Prescription')],
            'prescription.tablets' => ['bail', 'nullable', 'string', Rule::requiredIf($request->type == 'Prescription')],
            'prescription.cost' => ['bail', 'nullable', 'numeric', Rule::requiredIf($request->type == 'Prescription')],
            'prescription.chemists' => ['bail', 'nullable', 'string', Rule::requiredIf($request->type == 'Prescription')],
        ]);

        if($request->type == 'Prescription') unset($data['appointment']);
        if($request->type == 'Appointment') unset($data['prescription']);

        array_values($data);

        info($data);
        
        $request->response()->create($data);

        info('Responses: ' . $request->response()->count());

        return redirect()->route('doctor.requests.responses.index', $request);
    }
}
