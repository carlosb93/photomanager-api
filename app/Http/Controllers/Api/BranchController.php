<?php

namespace App\Http\Controllers\Api;

use App\Models\Branch;
use App\Models\Business;
use App\Models\RequestHistory;
use Illuminate\Http\Request;
use carbon\Carbon;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $last_request = auth()->user()
        //                       ->requesthistories()
        //                       ->where('request_type', 'index_branch')
        //                       ->orderBy('created_at', 'desc')
        //                       ->first();

        // if($last_request != NULL){
            $branches = auth()->user()->branch(auth()->user()->id);

        // }else{
        //     $branches = auth()->user()->branch(auth()->user()->id); 
        // }
        
// $branches = Branch::get();
    //    $last_request = new RequestHistory(); 
    //    $last_request->user_id = auth()->user()->id; 
    //    $last_request->request_type = 'index_branch'; 
    //    $last_request->created_at = carbon::now(); 
    //    $last_request->save(); 
        
        
 
        return response()->json($branches);
    }
 
    public function show($id)
    {

        $branch = auth()->user()->branches()->find($id);
 
        if (!$branch) {
            return response()->json('sorry', 400);
        }
 
        return response()->json( [$branch->toArray()] , 200);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'categoria_id' => 'required|integer',
            'code' => 'required',
        ]);
        $business = Business::where('user_id',auth()->user()->id)->get();

        $branch = new Branch();
        $branch->name = $request->name;
        $branch->description = $request->description;
        $branch->code = $request->code;
        $branch->categoria_id = 0;
        $branch->business_id =  $business[0]->id;

        if (auth()->user()->branches()->save($branch))
            return response()->json('done'
            //     [
            //     'success' => true,
            //     'data' => $branch->toArray()
            // ]
        );
        else
            return response()->json('sorry'
            //     [
            //     'success' => false,
            //     'message' => 'branch could not be added'
            // ]
            , 500);
    }
 
    public function update(Request $request, $id)
    {
        $branch = auth()->user()->branches()->find($id);
 
        if (!$branch) {
            return response()->json('sorry', 400);
        }
 
        $updated = $branch->fill($request->all())->save();
 
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
            //     'message' => 'branch could not be updated'
            // ]
            , 500);
    }
 
    public function destroy($id)
    {
        $branch = auth()->user()->branches()->find($id);
 
        if (!$branch) {
            return response()->json('sorry'
            //     [
            //     'success' => false,
            //     'message' => 'branch with id ' . $id . ' not found'
            // ]
            , 400);
        }
 
        if ($branch->delete()) {
            return response()->json('done'
            //     [
            //     'success' => true
            // ]
        );
        } else {
            return response()->json('sorry'
            //     [
            //     'success' => false,
            //     'message' => 'branch could not be deleted'
            // ]
            , 500);
        }
    }

}
