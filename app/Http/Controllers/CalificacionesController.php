<?php

namespace App\Http\Controllers;

use App\Models\Calificaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Focades\Validator;

class CalificacionesController extends Controller
{
    //Enpoint Para el listado de calificaciones
    public function select(){
        try{
            $calificaciones = Calificaciones::all();
            if($calificaciones->count()>0){
                return response()->json([
                    'code'=>200,
                    'data'=>$calificaciones
                ],200);
            }else{
                return response()->json([
                    'code'=>404,
                    'data'=>'No hay calificaciones en la base de datos'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }
    /* Enpoint Para  insertar calificaciones */
    public function insertar(Request $request){
        try{
            //Validar campos de la tabla calificaciones
            $validacion = Validator::make($request->all(),[
                'calificacion_id' => 'required',
                'id' => 'required',
                'restaurante_id' => 'required',
                'calificacion' => 'required',
                'comentario' => 'required',
                'fecha_calificacion' => 'required',
            ]);
            //Si la respuesta esta mala
            if($validacion -> fails()){
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $calificaciones = Calificaciones::create($request->all());
                return response()->json([
                    'code' => 200,
                    'data' => 'Calificacion Creada'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoint para modificar calificaciones */
    public function update(Request $request, $usuario_id){
        try{
            //validar campos requeridos
            $validacion = Validator::make($request->all(),[
                'calificacion_id' => 'required',
                'id' => 'required',
                'restaurante_id' => 'required',
                'calificacion' => 'required',
                'comentario' => 'required',
                'fecha_calificacion' => 'required',
            ]);
            //su la respuesta esta mala 
            if($validacion -> fails()){
                return reponse()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $calificacinoes = Calificaciones::find($calificaion_id);
                if($calificacinoes){
                    $calificaciones->update($request->all());
                    return response()->json([
                    'code' => 200,
                    'data' => 'calificacion Actulizada'
                    ],200);
                }else{
                    return response()->json([
                        'code' => 204,
                        'data' => 'Calificacino no encontrado'
                    ],204);
                }
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoint para eliminar Calificaciones */
    public function delete($calificacion_id){
        try{
            $calificaciones =  Calificaciones::find($calificacion_id);
            if($calificaciones){
                $calificaciones->delete($calificaion_id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Calificacion Eliminada'
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Calificacion no encontrada'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoin para buscar Calificaiones */
    public function find($calificacion_id){
        try{
            //buscar calificaciones
            $calificaciones = Calificaciones::find($calificacion_id);
            if($calificaciones){
                $datos = Calificaciones::select('calificaiones.calificacion_id','calificaciones.id',
                'calificaciones.restaurante_id','calificaciones.restaurante_id','calificaciones.calificacion',
                'calificaciones.comentario',
                'calificaciones.fecha_calificacion')
                ->join('users','calificaciones.id','=','users.id')
                ->join('restaurantes','calificaciones.restaurnate_id','=','restaurantes.restaurante_id')
                ->where('calificaciones.calificacion_id','=',$calificacion_id)
                ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Calificacion no encontrado'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }
}
