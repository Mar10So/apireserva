<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    //Enpoint Para el listado de Usuarios
    public function select(){
        try{
            $usuarios = Usuarios::all();
            if($usuarios->count()>0){
                return response()->json([
                    'code'=>200,
                    'data'=>$usuarios
                ],200);
            }else{
                return response()->json([
                    'code'=>404,
                    'data'=>'No hay clientes en la base de datos'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }
    /* Enpoint Para  insertar clientes */
    public function insertar(Request $request){
        try{
            //Validar campos de la tabla clientes
            $validacion = Validator::make($request->all(),[
                'usuario_id' => 'required',
                'nombre' => 'required',
                'email' => 'required',
                'pasword' => 'required',
                'telefono' => 'required',
            ]);
            //Si la respuesta esta mala
            if($validacion -> fails()){
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $usuarios = Usuarios::create($request->all());
                return response()->json([
                    'code' => 200,
                    'data' => 'Usuario Creado'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoint para modificar usuarios */
    public function update(Request $request, $usuario_id){
        try{
            //validar campos requeridos
            $validacion = Validator::make($request->all(),[
                'usuario_id' => 'required',
                'nombre' => 'required',
                'email' => 'required',
                'pasword' => 'required',
                'telefono' => 'required',
            ]);
            //su la respuesta esta mala 
            if($validacion -> fails()){
                return reponse()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $usuarios = Usuarios::find($usuario_id);
                if($usuarios){
                    $usuarios->update($request->all());
                    return response()->json([
                    'code' => 200,
                    'data' => 'Usuario Actulizado'
                    ],200);
                }else{
                    return response()->json([
                        'code' => 204,
                        'data' => 'Usuario no encontrado'
                    ],204);
                }
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoint para eliminar usuarios */
    public function delete($usuario_id){
        try{
            $usuarios = Usuarios::find($usuario_id);
            if($usuarios){
                $usuarios->delete($usuario_id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Usuario Eliminado'
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Usuario no encontrado'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoin para buscar usuarios */
    public function find($usuario_id){
        try{
            //buscar usuario
            $usuarios = Usuarios::find($usuario_id);
            if($usuarios){
                $datos = Usuarios::select('usuarios.usuario_id','usuario.nombre','usuarios.email','usuarios.pasword','usuarios.telefono')
                ->where('usuarios.usuario_id','=', $usuario_id)
                ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Usuario o encontrado'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

}
