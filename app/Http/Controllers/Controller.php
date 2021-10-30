<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function pruebas(Request $request){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        $image=$request->file('image');
    
        if($image){
            $image_path=$image->getClientOriginalName();
            $data=array(
                'image'=>$image, 
                'status'=>'success',
                'code'  =>200
            );
        }else{
            $data=array(
                'status'=>'error',
                'code'  =>400
            );
        }
        
        return response()->json($data,$data['code']);
        

    }


}
