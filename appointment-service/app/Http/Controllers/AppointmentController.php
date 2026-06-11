<?php

namespace App\Http\Controllers;

use App\Jobs\SendAppointmentNotification;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AppointmentController extends Controller
{
    private $patientServiceUrl;
    private $doctorServiceUrl;

    public function __construct()
    {
        $this->patientServiceUrl = env('PATIENT_SERVICE_URL');
        $this->doctorServiceUrl  = env('DOCTOR_SERVICE_URL');
    }

    public function index()
    {
        $appointments = Appointment::orderBy('appointment_date', 'asc')->get();

        return response()->json([
            'success' => true,
            'data'    => $appointments,
        ]);
    }

    public function show($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $appointment,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id'       => 'required|integer',
            'doctor_id'        => 'required|integer',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'complaint'        => 'required|string',
        ]);

        $patientResponse = Http::get("{$this->patientServiceUrl}/patients/{$validated['patient_id']}");

        if ($patientResponse->failed() || !$patientResponse->json('success')) {
            return response()->json([
                'success' => false,
                'message' => 'Patient not found in PatientService',
            ], 404);
        }

        $patient = $patientResponse->json('data');

        $doctorResponse = Http::get("{$this->doctorServiceUrl}/doctors/{$validated['doctor_id']}");

        if ($doctorResponse->failed() || !$doctorResponse->json('success')) {
            return response()->json([
                'success' => false,
                'message' => 'Doctor not found in DoctorService',
            ], 404);
        }

        $doctor = $doctorResponse->json('data');

        $appointment = Appointment::create([
            'patient_id'            => $validated['patient_id'],
            'doctor_id'             => $validated['doctor_id'],
            'appointment_date'      => $validated['appointment_date'],
            'appointment_time'      => $validated['appointment_time'],
            'complaint'             => $validated['complaint'],
            'status'                => 'pending',
            'consultation_fee'      => $doctor['consultation_fee'],
            'patient_name'          => $patient['name'],
            'doctor_name'           => $doctor['name'],
            'doctor_specialization' => $doctor['specialization'],
        ]);

        SendAppointmentNotification::dispatch(
            $appointment->toArray(),
            'appointment_created'
        )->onQueue('notifications');

        return response()->json([
            'success' => true,
            'message' => 'Appointment created successfully',
            'data'    => $appointment,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found',
            ], 404);
        }

        $validated = $request->validate([
            'status'           => 'sometimes|in:pending,confirmed,completed,cancelled',
            'notes'            => 'sometimes|nullable|string',
            'appointment_date' => 'sometimes|date',
            'appointment_time' => 'sometimes|date_format:H:i',
            'patient_name'     => 'sometimes|string',
            'doctor_name'      => 'sometimes|string',
        ]);

        $appointment->update($validated);

        SendAppointmentNotification::dispatch(
            $appointment->fresh()->toArray(),
            'appointment_updated'
        )->onQueue('notifications');

        return response()->json([
            'success' => true,
            'message' => 'Appointment updated successfully',
            'data'    => $appointment->fresh(),
        ]);
    }

    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found',
            ], 404);
        }

        $appointment->update(['status' => 'cancelled']);

        SendAppointmentNotification::dispatch(
            $appointment->fresh()->toArray(),
            'appointment_cancelled'
        )->onQueue('notifications');

        return response()->json([
            'success' => true,
            'message' => 'Appointment cancelled successfully',
        ]);
    }

    public function byPatient($patientId)
    {
        $appointments = Appointment::where('patient_id', $patientId)
            ->orderBy('appointment_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $appointments,
        ]);
    }

    public function byDoctor($doctorId)
    {
        $appointments = Appointment::where('doctor_id', $doctorId)
            ->orderBy('appointment_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $appointments,
        ]);
    }
}