<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{

    public function lista(){
        return response()->json(Usuario::all(), 200);
    }

    public function info($id){
        return response()->json(Usuario::where('id', '=', $id)->first());
    }



}//final clase
