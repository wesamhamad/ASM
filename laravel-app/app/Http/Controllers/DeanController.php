<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DeanController extends Controller
{
    public function index()
    {
        $dean = auth()->user()->dean;

        if ($dean) {
            $appointments = Appointment::with('student.user')
                ->where('dean_id', $dean->dean_id)
                ->get();

            return view('dean.appointments.index', compact('appointments'));
        }

        return redirect()->back()->with('error', 'You are not authorized to view this page.');
    }

    public function filter(Request $request)
    {
        $dean = auth()->user()->dean;

        if ($dean) {
            $filters = $request->only(['date_range', 'student_name']);

            $appointments = Appointment::with('student.user')
                ->where('dean_id', $dean->dean_id)
                ->whereHas('student.user', function($query) use ($filters) {
                    if (!empty($filters['student_name'])) {
                        $query->where('name', 'like', '%' . $filters['student_name'] . '%');
                    }
                })
                ->get();

            return view('dean.appointments.index', compact('appointments'));
        }

        return redirect()->back()->with('error', 'You are not authorized to view this page.');
    }
}
