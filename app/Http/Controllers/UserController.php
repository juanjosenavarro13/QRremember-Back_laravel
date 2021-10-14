<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function register(Request $request){

        if(!is_null($request->all())){//tenemos los datos

            //validacion de datos
            $valitador = Validator::make($request->all(),[
                'nombre'                    => 'required|alpha|max:10',
                'email'                     => 'required|unique:users|email|max:20',
                'password'                  => 'required|min:6|confirmed',
            ]);

            if($valitador->fails()){//si hay algun error en la validacion
                $res = [
                    'status'    => 'error',
                    'code'      => 400,
                    'message'   => 'Error al validar datos. ' . $valitador->errors()
                ];
            }else{// si se han validado todos los datos correctamente
                $user = new User();
                $user->nombre = $request->nombre;
                $user->email = $request->email;
                $user->password = hash('SHA256', $request->password);
                $user->role = 'USER';
                $user->active = 0;
                $user->save();

                $res = [
                    'status'    => 'success',
                    'code'      => 200,
                    'message'   => 'Usuario '. $user->email .' registrado correctamente',
                    'user'      => $user
                ];

            }
            
        }else{//si no recibimos datos
            $res = [
                'status'    => 'error',
                'code'      => 400,
                'message'   => 'No se han recibido datos'
            ];
        }

        //respuesta
        $controller = new Controller();
        $controller->log_save('REGISTRO', $res['message'], $request->ip());
        return response()->json($res, $res['code']);

    } //final register

    public function login(Request $request){
        if(!is_null($request->all())){//tenemos los datos

            //validacion de datos
            $valitador = Validator::make($request->all(),[
                'email'                     => 'required|email|max:20',
                'password'                  => 'required|min:6',
            ]);

            if($valitador->fails()){//si hay algun error en la validacion
                $res = [
                    'status'    => 'error',
                    'code'      => 400,
                    'message'   => 'Error al validar datos. ' . $valitador->errors()
                ];
            }else{// si se han validado todos los datos correctamente
                $user = User::where('email', '=', $request->email)
                ->where('password', '=', hash('SHA256', $request->password))->first();

                if(!is_null($user)){//si no se encuentra el usuario
                    $res = [
                        'status'    => 'success',
                        'code'      => 200,
                        'message'   => 'El usuario '. $request->email .' ha iniciado sesion correctamente',
                    ];
                }else{//si se encuentra el usuario
                    $res = [
                        'status'    => 'error',
                        'code'      => 400,
                        'message'   => 'El usuario '. $request->email .' no ha podido identificarse',
                    ];
                }

                

            }
            
        }else{//si no recibimos datos
            $res = [
                'status'    => 'error',
                'code'      => 400,
                'message'   => 'No se han recibido datos'
            ];
        }

        //respuesta
        $controller = new Controller();
        $controller->log_save('LOGIN', $res['message'], $request->ip());
        return response()->json($res, $res['code']);
    }//final login

    public function lista(){
        $res = [
            'code'          => 200,
            'message'       => 'lista de usuarios',
            'usuarios'      => User::all()
        ];

       //respuesta
        return response()->json($res, $res['code']);

    }//final admin_lista_users



}//final clase
