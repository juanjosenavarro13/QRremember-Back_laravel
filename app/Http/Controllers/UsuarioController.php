<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{

    public function lista(){
        return response()->json(Usuario::orderBy('id', 'DESC')->get(), 200);
    }

    public function info($id){
        return response()->json(Usuario::where('id', '=', $id)->first());
    }

    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'nombre'        => 'required',
            'email'         => 'required|email|unique:usuarios',
            'role'          => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }else{
            $usuario = Usuario::where('id', '=', $id)->first();
            $usuario->nombre = $request->nombre;
            $usuario->email = $request->email;
            $usuario->role = $request->role;
            $usuario->save();

            return response()->json($usuario,200);
        }

    }

    public function delete($id){
        $usuario = Usuario::where('id', '=', $id)->first();
        $usuario->delete();
        return response()->json('Usuario eliminado', 200);
    }



}//final clase
