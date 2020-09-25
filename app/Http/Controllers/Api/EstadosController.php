<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estados;

class EstadosController extends Controller
{
    public function index(){
        $request ='Iniciado,Activo,Inactivo,Finalizado,Cancelado';
        $str_arr = explode(",", $request);
        foreach($str_arr as $item){
            $estado = new Estados();
            $estado->nombre = $item;
            $estado->save();
        }
        return response('creados', 200);
        
    }
}
