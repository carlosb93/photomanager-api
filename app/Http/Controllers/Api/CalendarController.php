<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Calendar;

class CalendarController extends Controller
{
    public function index()
    {
        $events=[];
        
        
 
        return response()->json($events);
    }
 
}
