<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Business;
use App\User;
use carbon\Carbon;
use DB;

class HomeController extends Controller
{
    

    public function index()
    {
        $user = auth()->user();
        $branch = $user->branch($user->id);
        return response()->json(['user' => $user, 
                                 'role' => $user->role($user->id),
                                 'branch' => $branch[0],
                                 'business' => $user->business($branch[0]->business_id)[0],
                                ]);
    }
    public function initialsetup()
    {
        $name_app = DB::table('config_app')->where('id',1)->get();
       
        return response()->json( [$name_app->toArray()] , 200);
        
    }
  

}
