<?php

namespace App\Http\Controllers;

use App\Models\Dean;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAvailableSlots($deanId)
    {
        $dean = Dean::findOrFail($deanId);
        return response()->json(json_decode($dean->time_slots));
    }
}
