<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fallecido;
use Illuminate\Support\Facades\Validator;

class FallecidoController extends Controller
{
    public function ultimos_fallecidos(){
        $res = Fallecido::take(10)->orderBy('fecha_fallecimiento', 'desc')->get();

        return response()->json($res, 200);
    }

    public function fallecido_info($id){
        $res = Fallecido::select('fallecidos.*', 'usuarios.nombre AS user_nombre',)
        ->join('usuarios', 'usuarios.id', '=', 'fallecidos.user_id')->where('fallecidos.id','=', $id)
        ->first();

        return response()->json($res, 200);
    }

    public function crear_fallecido(Request $request){

        $validator = Validator::make($request->all(),[
            'nombre'                => 'required|max:20',
            'apellidos'             => 'required|max:50',
            'fecha_nacimiento'      => 'required|date|date_format:Y-m-d',
            'fecha_fallecimiento'   => 'required|date|date_format:Y-m-d',
            'descripcion'           => 'required|string',
            'user_id'               => 'required|integer',
            'clave'                 => 'nullable|string'
        ]);

        if($validator->fails()){
            return $validator->errors();
        }else{
            $fallecido = new Fallecido();
            $fallecido->nombre = $request->nombre;
            $fallecido->apellidos = $request->apellidos;
            $fallecido->fecha_nacimiento = $request->fecha_nacimiento;
            $fallecido->fecha_fallecimiento = $request->fecha_fallecimiento;
            $fallecido->descripcion = $request->descripcion;
            $fallecido->user_id = $request->user_id;

            

            if(!is_null($request->clave)){
                $fallecido->clave = $request->clave;
            }

            $fallecido->save();

            return response()->json($fallecido, 200);
        }       
    }

    public function imagen_perfil(Request $request, $id){

        $file = $request->file('image');

        if($file){
             //obtenemos el nombre del archivo
        $nombre =  time()."_".$file->getClientOriginalName();
        //indicamos que queremos guardar un nuevo archivo en el disco local
        \Storage::disk('imgPerfil')->put($nombre,  \File::get($file));
        $fallecido = Fallecido::where('id', '=', $id)->first();
        $fallecido->imagen = 'storage/app/imgPerfil/'.$nombre;
        $fallecido->save();
        return response()->json("guardado correctamente",200);
        }else{
            return response()->json('error', 400);
        }
        
       
        
        
    }

    public function lista(){
        $fallecidos = Fallecido::select('fallecidos.*', 'usuarios.nombre AS user_nombre',)
        ->join('usuarios', 'usuarios.id', '=', 'fallecidos.user_id')->orderBy('id', 'DESC')
        ->get();
        
        return response()->json($fallecidos, 200);
    }

    public function delete($id){
        $fallecido = Fallecido::where('id', '=', $id)->first();
        $fallecido->delete();
        return response()->json('Fallecido eliminado', 200);
    }

    public function actualizar(Request $request, $id){

        $fallecido = Fallecido::where('id', '=', $id)->first();

        $fallecido->nombre = $request->nombre;
        $fallecido->apellidos = $request->apellidos;
        $fallecido->fecha_nacimiento = $request->fecha_nacimiento;
        $fallecido->fecha_fallecimiento = $request->fecha_fallecimiento;
        $fallecido->descripcion = $request->descripcion;
        $fallecido->user_id = $request->user_id;
        $fallecido->clave = $request->clave;

        $fallecido->save();
        return response()->json($fallecido, 200);

    }

    public function obtenerUsuarioMain($id){
        return response()->json(Fallecido::where('user_id', '=', $id)->first());
    }

}
