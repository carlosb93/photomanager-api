<?php

namespace App\Http\Controllers\Api;

use App\Models\Business;
use App\Models\Branch;

use Illuminate\Support\Facades\DB;
use App\Models\RequestHistory;
use Illuminate\Http\Request;
use carbon\Carbon;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $last_request = auth()->user()
                              ->requesthistories()
                              ->where('request_type', 'index_business')
                              ->orderBy('created_at', 'desc')
                              ->first();
                             

        if($last_request){
            $businesses = auth()->user()->businesses()->where('created_at','>',$last_request->created_at)->orWhere('updated_at','>',$last_request->created_at);

        }else{
            $businesses = auth()->user()->businesses; 
        }

       $last_request = new RequestHistory(); 
       $last_request->user_id = auth()->user()->id; 
       $last_request->request_type = 'index_business'; 
       $last_request->created_at = carbon::now(); 
       $last_request->save(); 


        $businesses = auth()->user()->businesses;
 
        return response()->json($businesses);
    }
 
    public function show($id)
    {
        $business = auth()->user()->businesses()->find($id);
 
        if (!$business) {
            return response()->json('sorry', 400);
        }
 
        return response()->json( [$business->toArray()] , 200);
    }
 
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        
        $business = new Business();
        $business->name = $request->name;
        $business->description = $request->description;
        $business->user_id = auth()->user()->id;

        if (auth()->user()->businesses()->save($business)){

        
        $branch = new Branch();
        $branch->name = 'Branch of '. $request->name;
        $branch->description = '';
        $branch->code = 'CUDA2';
        $branch->business_id = $business->id;
        $branch->categoria_id = 1;
        $branch->disabled = false;
        $branch->save();

        $branch_user = array([
            [
				'user_id' => auth()->user()->id, 
				'branch_id' => $branch->id,
                'created_at' => Carbon::now()				
            ]
        ]);
       
        foreach($branch_user as $item){
            DB::table('branch_user')->insert($item);
        }
    
            return response()->json('done'
            //     [
            //     'success' => true,
            //     'data' => $business->toArray()
            // ]
        );

    }else{
            return response()->json('sorry'
            //     [
            //     'success' => false,
            //     'message' => 'business could not be added'
            // ]
            , 500);
        }
    }
 
    public function update(Request $request, $id)
    {
        
        $business = auth()->user()->businesses()->find($id);
       
        if (!$business) {
            return response()->json('sorry', 400);
        }
 
        $business->name = $request->name;
        $business->description = $request->description;
 
        if ($business->save())
            return response()->json('done'
            //     [
            //     'success' => true
            // ]
        );
        else
            return response()->json('sorry'
            //     [
            //     'success' => false,
            //     'message' => 'business could not be updated'
            // ]
            , 500);
    }
 
    public function destroy($id)
    {
        $business = auth()->user()->businesses()->find($id);
 
        if (!$business) {
            return response()->json('sorry'
            //     [
            //     'success' => false,
            //     'message' => 'business with id ' . $id . ' not found'
            // ]
            , 400);
        }
 
        if ($business->delete()) {
            return response()->json('done'
            //     [
            //     'success' => true
            // ]
        );
        } else {
            return response()->json('sorry'
            //     [
            //     'success' => false,
            //     'message' => 'business could not be deleted'
            // ]
            , 500);
        }
    }

}
