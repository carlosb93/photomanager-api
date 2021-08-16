<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tramites;
use App\Models\Oferta;
use carbon\Carbon;
use DB;

class HomeController extends Controller
{
    

    public function index()
    {

        return view('welcome');
    }
    
    
    
}
