<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        if(auth()->user()->role(auth()->user()->id)->name == "Administrator"){
            $roles = Role::get();

        }else{
             $roles = Role::where('id','!=','1')->get();
        }
 
        return response()->json($roles);
    }
 
    public function show($id)
    {
        $role = Role::where('id', $id)->first();
 
        if (!$role) {
            return response()->json('sorry', 400);
        }
 
        return response()->json( [$role->toArray()] , 200);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
 
        $role = new role();
        $role->name = $request->name;
        $role->description = $request->description;
        
        if ($role->save())
            return response()->json('done'
            //     [
            //     'success' => true,
            //     'data' => $role->toArray()
            // ]
        );
        else
            return response()->json('sorry'
            //     [
            //     'success' => false,
            //     'message' => 'role could not be added'
            // ]
            , 500);
    }
 
    public function update(Request $request, $id)
    {
        $role = Role::where('id', $id)->first();
 
        if (!$role) {
            return response()->json('sorry', 400);
        }
 
        $updated = $role->fill($request->all())->save();
 
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
            //     'message' => 'role could not be updated'
            // ]
            , 500);
    }
 
    public function destroy($id)
    {
        $role = Role::where('id',$id)->first();
 
        if (!$role) {
            return response()->json('sorry'
            //     [
            //     'success' => false,
            //     'message' => 'role with id ' . $id . ' not found'
            // ]
            , 400);
        }
 
        if ($role->delete()) {
            return response()->json('done'
            //     [
            //     'success' => true
            // ]
        );
        } else {
            return response()->json('sorry'
            //     [
            //     'success' => false,
            //     'message' => 'role could not be deleted'
            // ]
            , 500);
        }
    }

}
