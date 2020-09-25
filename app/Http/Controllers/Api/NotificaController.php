<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notifica;
use App\User;
use carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\NotifyEvent;

class NotificaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        

        //$user_id = User::where('id',$id)->pluck('id');
        
        $response = Notifica::where('user_id',$id)->get();
        return response(['data' => $response], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $notifica = new Notifica();
        $notifica->user_id = $id; 
        $notifica->msg = $request->msg; 
        $notifica->url = $request->url; 
        $notifica->type = $request->type; 
        $notifica->created_at = carbon::now(); 
        $notifica->save(); 
        broadcast(new NotifyEvent($notifica));

        return response('Notificacion creada!!!', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notifica  $notifica
     * @return \Illuminate\Http\Response
     */
    public function show(Notifica $notifica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notifica  $notifica
     * @return \Illuminate\Http\Response
     */
    public function edit(Notifica $notifica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notifica  $notifica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notifica $notifica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notifica  $notifica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notifica $notifica, $id)
    {
        $notifica = Notifica::where('id',$id)->delete();
        return response('Notificacion eliminada!!!', 200);
    }
}
