<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::where('status', 'active')->get();

        return response()->json([
            'success' => true,
            'data'    => $patients,
        ]);
    }

    public function show($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Patient not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $patient,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                    => 'required|string|max:255',
            'gender'                  => 'required|in:male,female',
            'birth_date'              => 'required|date',
            'nik'                     => 'required|string|size:16|unique:patients',
            'phone'                   => 'required|string|max:20',
            'email'                   => 'nullable|email',
            'address'                 => 'required|string',
            'blood_type'              => 'nullable|in:A,B,AB,O',
            'emergency_contact_name'  => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
        ]);

        $patient = Patient::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Patient created successfully',
            'data'    => $patient,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Patient not found',
            ], 404);
        }

        $validated = $request->validate([
            'name'                    => 'sometimes|string|max:255',
            'phone'                   => 'sometimes|string|max:20',
            'email'                   => 'nullable|email',
            'address'                 => 'sometimes|string',
            'blood_type'              => 'nullable|in:A,B,AB,O',
            'emergency_contact_name'  => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'status'                  => 'sometimes|in:active,inactive',
        ]);

        $patient->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Patient updated successfully',
            'data'    => $patient,
        ]);
    }

    public function destroy($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Patient not found',
            ], 404);
        }

        $patient->update(['status' => 'inactive']);

        return response()->json([
            'success' => true,
            'message' => 'Patient deactivated successfully',
        ]);
    }

    public function appointments($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Patient not found',
            ], 404);
        }

        $appointmentServiceUrl = env('APPOINTMENT_SERVICE_URL');

        $response = Http::get("{$appointmentServiceUrl}/appointments/patient/{$id}");

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch appointments from AppointmentService',
            ], 503);
        }

        return response()->json([
            'success' => true,
            'data'    => [
                'patient'      => $patient,
                'appointments' => $response->json('data'),
            ],
        ]);
    }
}
