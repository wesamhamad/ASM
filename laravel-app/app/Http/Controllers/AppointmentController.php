<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Dean;
use App\Models\Student; // Add this import
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Fetch appointments only for the logged-in student
        $appointments = Appointment::with('dean.user')
            ->where('student_id', $user->student->student_id)  // Use the correct student_id
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        // Eager load the user relationship to get the name
        $deans = Dean::with('user')->get(); // Fetch all deans with user relationship
        return view('appointments.create', compact('deans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dean_id' => 'required|exists:deans,dean_id',
            'slot_id' => 'required|integer',
        ]);

        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student record not found.');
        }

        $dean = Dean::findOrFail($request->dean_id);
        $slots = json_decode($dean->time_slots, true);

        if ($slots[$request->slot_id]['status'] === 'available') {
            // Mark the slot as reserved
            $slots[$request->slot_id]['status'] = 'reserved';
            $dean->time_slots = json_encode($slots);
            $dean->save();

            // Create the appointment
            Appointment::create([
                'student_id' => $student->student_id, // Use the correct student_id
                'dean_id' => $request->dean_id,
                'appointment_time' => $slots[$request->slot_id]['time'],
                'status' => 'pending',
                'coordinator_id' => $dean->coordinator_id,
            ]);

            return redirect()->route('appointments.index')->with('success', 'تم حجز الموعد بنجاح.');
        }

        return redirect()->back()->with('error', 'الوقت المحدد محجوز بالفعل.');
    }
}
