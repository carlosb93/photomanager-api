<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User; 
use App\Models\Business; 
use App\Models\Branch; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\NotificaUser;
use carbon\Carbon;
use App\Events\NotifyEvent;

class UserController extends Controller
{



    public function index()
    {
     
        if(auth()->user()->role(auth()->user()->id)->name == "Administrator"){
            // $users = User::get();
            $business = auth()->user()->businesses;
            $branch = Branch::where('business_id',$business[0]->id)->get();
            foreach($branch as $item){
                $user_id = DB::table('branch_user')->where('branch_id',$item->id)->get()->pluck('user_id');
            }
           $users = User::whereIn('id',$user_id)->with('branches')->get();
            

        }else if(auth()->user()->role(auth()->user()->id)->name == "Admin_negocio"){

            $business = auth()->user()->businesses;
            $branch = Branch::where('business_id',$business[0]->id)->get();
            foreach($branch as $item){
                $user_id = DB::table('branch_user')->where('branch_id',$item->id)->get()->pluck('user_id');
            }
           $users = User::whereIn('id',$user_id)->with('branches')->get();
            
        }
        return response()->json(['users' => $users,'bussines' => auth()->user()->businesses]);
    }
 

    public function show($id)
    {
        $user = User::where('id',$id)->first();
 
        if (!$user) {
            return response()->json('sorry', 400);
        }
 
        return response()->json( [$user->toArray()] , 200);
    }
 

 
    public function update(Request $request, $id)
    {
        $user =  User::where('id',$id)->first();
 
        if (!$user) {
            return response()->json('sorry', 400);
        }
 
        $updated = $user->fill($request->all())->save();
 
        if ($updated)
            return response()->json('done'
            //     [
            //     'success' => true
            // ]
        );
        else
            return response()->json('sorry'
            //     [
            //     'success' => false,
            //     'message' => 'user could not be updated'
            // ]
            , 500);
    }
 
    public function destroy($id)
    {
        $user =  User::where('id',$id)->first();
 
        if (!$user) {
            return response()->json('sorry'
            //     [
            //     'success' => false,
            //     'message' => 'user with id ' . $id . ' not found'
            // ]
            , 400);
        }
 
        if ($user->delete()) {
            return response()->json('done'
            //     [
            //     'success' => true
            // ]
        );
        } else {
            return response()->json('sorry'
            //     [
            //     'success' => false,
            //     'message' => 'user could not be deleted'
            // ]
            , 500);
        }
    }
}
