<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('schedules')
            ->where('status', 'active')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $doctors,
        ]);
    }

    public function show($id)
    {
        $doctor = Doctor::with('schedules')->find($id);

        if (!$doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Doctor not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $doctor,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'gender'           => 'required|in:male,female',
            'birth_date'       => 'required|date',
            'nip'              => 'required|string|unique:doctors',
            'phone'            => 'required|string|max:20',
            'email'            => 'required|email|unique:doctors',
            'specialization'   => 'required|string',
            'license_number'   => 'required|string|unique:doctors',
            'experience_years' => 'required|integer|min:0',
            'education'        => 'required|string',
            'consultation_fee' => 'required|numeric|min:0',
        ]);

        $doctor = Doctor::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Doctor created successfully',
            'data'    => $doctor,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Doctor not found',
            ], 404);
        }

        $validated = $request->validate([
            'phone'            => 'sometimes|string|max:20',
            'email'            => 'sometimes|email|unique:doctors,email,' . $id,
            'specialization'   => 'sometimes|string',
            'experience_years' => 'sometimes|integer|min:0',
            'education'        => 'sometimes|string',
            'consultation_fee' => 'sometimes|numeric|min:0',
            'status'           => 'sometimes|in:active,inactive',
        ]);

        $doctor->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Doctor updated successfully',
            'data'    => $doctor->fresh('schedules'),
        ]);
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Doctor not found',
            ], 404);
        }

        $doctor->update(['status' => 'inactive']);

        return response()->json([
            'success' => true,
            'message' => 'Doctor deactivated successfully',
        ]);
    }

    public function schedules($id)
    {
        $doctor = Doctor::with('schedules')->find($id);

        if (!$doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Doctor not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => [
                'doctor'    => $doctor->name,
                'schedules' => $doctor->schedules,
            ],
        ]);
    }
    public function addSchedule(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Doctor not found',
            ], 404);
        }

        $validated = $request->validate([
            'day'          => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i|after:start_time',
            'max_patients' => 'sometimes|integer|min:1',
        ]);

        $schedule = DoctorSchedule::create([
            'doctor_id'    => $doctor->id,
            'day'          => $validated['day'],
            'start_time'   => $validated['start_time'],
            'end_time'     => $validated['end_time'],
            'max_patients' => $validated['max_patients'] ?? 20,
            'status'       => 'available',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Schedule added successfully',
            'data'    => [
                'doctor'   => $doctor->name,
                'schedule' => $schedule,
            ],
        ], 201);
    }
}
