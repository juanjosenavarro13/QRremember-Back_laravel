<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Imagen;

class ImagenController extends Controller
{
    
    public function subir(Request $request, $id){
        $file = $request->file('imagen');

        if($file){
             //obtenemos el nombre del archivo
            $nombre =  time()."_".$file->getClientOriginalName();
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('imgFallecidos')->put($nombre,  \File::get($file));
            $imagen = new Imagen();
            $imagen->url = 'storage/app/imgFallecidos/'.$nombre;
            $imagen->id_fallecido = $id;
            $imagen->save();
            return response()->json("guardado correctamente",200);
        }else{
            return response()->json('error', 400);
        }
    }

    public function ver($id){
        if($id){
            $imagenes = Imagen::where('id_fallecido', '=', $id)->get();
            return response()->json($imagenes, 200);
        }else{
            return response()->json('error', 400);
        }
    }

}
