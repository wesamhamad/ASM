<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class CoordinatorController extends Controller
{
    public function index()
    {
        $coordinator = Auth::user()->coordinator;

        if (!$coordinator) {
            return redirect()->back()->with('error', 'You are not authorized to view this page.');
        }

        // Fetch appointments for the dean associated with the coordinator
        $appointments = Appointment::with(['student.user', 'dean.user'])
            ->whereIn('dean_id', $coordinator->deans->pluck('dean_id'))
            ->get();

        return view('coordinator.appointments.index', compact('appointments'));
    }

    public function updateMultiple(Request $request)
    {
        $request->validate([
            'appointment_ids' => 'required|array',
            'appointment_ids.*' => 'exists:appointments,appointment_id',
            'appointment_time' => 'nullable|array',
            'appointment_time.*' => 'nullable|date',
            'status' => 'required|array',
            'status.*' => 'required|in:pending,confirmed,canceled',
        ]);

        $appointmentIds = $request->appointment_ids;
        $appointmentTimes = $request->appointment_time;
        $statuses = $request->status;

        foreach ($appointmentIds as $appointmentId) {
            $data = [
                'status' => $statuses[$appointmentId],
            ];
            if (isset($appointmentTimes[$appointmentId])) {
                $data['appointment_time'] = $appointmentTimes[$appointmentId];
            }
            Appointment::where('appointment_id', $appointmentId)
                ->update($data);
        }

        return redirect()->route('coordinator.appointments.index')->with('success', 'تم التحديث بنجاح');
    }
}
