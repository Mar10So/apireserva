<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administracion_Restaurante;
use Illuminate\Support\Focades\Validator;

class AdministracionRestauranteController extends Controller
{
     //Enpoint Para el listado de administradores de restaurantes
     public function select(){
        try{
            $administrador = Administracion_Restaurante::all();
            if($administrador->count()>0){
                return response()->json([
                    'code'=>200,
                    'data'=>$administrador
                ],200);
            }else{
                return response()->json([
                    'code'=>404,
                    'data'=>'No hay administradores en la base de datos'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }
    /* Enpoint Para  insertar administradores de resturantes */
    public function insertar(Request $request){
        try{
            //Validar campos de la tabla Administracion_Restaurante
            $validacion = Validator::make($request->all(),[
                'admin_id' => 'required',
                'nombre_admin' => 'required',
                'email' => 'required',
                'pasword' => 'required',
                'rol' => 'required',
            ]);
            //Si la respuesta esta mala
            if($validacion -> fails()){
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $administrador = Administracion_Restaurante::create($request->all());
                return response()->json([
                    'code' => 200,
                    'data' => 'Administrador Creado'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoint para modificar administradores */
    public function update(Request $request, $admin_id){
        try{
            //validar campos requeridos
            $validacion = Validator::make($request->all(),[
                'admin_id' => 'required',
                'nombre_admin' => 'required',
                'email' => 'required',
                'pasword' => 'required',
                'rol' => 'required',
            ]);
            //su la respuesta esta mala 
            if($validacion -> fails()){
                return reponse()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $administrador = Usuarios::find($admin_id);
                if($administrador){
                    $administrador->update($request->all());
                    return response()->json([
                    'code' => 200,
                    'data' => 'Administrador Actulizado'
                    ],200);
                }else{
                    return response()->json([
                        'code' => 204,
                        'data' => 'Administrador no encontrado'
                    ],204);
                }
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoint para eliminar Administradores */
    public function delete($admin_id){
        try{
            $administrador = Administracion_Restaurante::find($admin_id);
            if($administrador){
                $administrador->delete($admin_id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Administrador Eliminado'
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Administrador no encontrado'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoin para buscar administradores */
    public function find($admin_id){
        try{
            //buscar usuario
            $administrador = Administracion_Restaurante::find($adimn_id);
            if($administrador){
                $datos = Administracion_Restaurante::select('administracion_restaurante.admin_id','administracion_restaurante.nombre_admin','administracion_restaurante.email','administracion_restaurante.pasword','administracion_restaurante.rol')
                ->where('administracion_restaurante.admin_id','=', $admin_id)
                ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Administrador no encontrado'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

}
