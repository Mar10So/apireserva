<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservasController extends Controller
{
    //Enpoint Para el listado de reservas
    public function select(){
        try{
            $reservas = Reservas::all();
            if($reservas->count()>0){
                return response()->json([
                    'code'=>200,
                    'data'=>$reservas
                ],200);
            }else{
                return response()->json([
                    'code'=>404,
                    'data'=>'No hay reservas en la base de datos'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }


    /* Enpoint Para  insertar reservas */
    public function insertar(Request $request){
        try{
            //Validar campos de la tabla reservas
            $validacion = Validator::make($request->all(),[
               /*  'reserva_id' => 'required', */
                'usuario_id' => 'required',
                'restaurante_id' => 'required',
                'fecha_reserva' => 'required',
                'hora_reserva' => 'required',
                'numero_personas' => 'required',
            ]);
            //Si la respuesta esta mala
            if($validacion -> fails()){
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $reservas = Reservas::create($request->all());
                return response()->json([
                    'code' => 200,
                    'data' => 'Reserva Creado'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoint para modificar Reserva */
    public function update(Request $request, $reserva_id){
        try{
            //validar campos requeridos
            $validacion = Validator::make($request->all(),[
                /* 'reserva_id' => 'required', */
                'usuario_id' => 'required',
                'restaurante_id' => 'required',
                'fecha_reserva' => 'required',
                'hora_reserva' => 'required',
                'numero_personas' => 'required',
            ]);
            //su la respuesta esta mala 
            if($validacion -> fails()){
                return reponse()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $reservas = Reservas::find($reserva_id);
                if($reservas){
                    $reservas->update($request->all());
                    return response()->json([
                    'code' => 200,
                    'data' => 'Reserva Actulizado'
                    ],200);
                }else{
                    return response()->json([
                        'code' => 204,
                        'data' => 'Reserva no encontrado'
                    ],204);
                }
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoint para eliminar Reserva */
    public function delete($reserva_id){
        try{
            $reservas = Reservas::find($reserva_id);
            if($reservas){
                $reservas->delete($reserva_id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Reserva Eliminada'
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Reserva no encontrado'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoin para buscar reservas */
    public function find($reserva_id){
        try{
            //buscar usuario
            $reservas = Reservas::find($reserva_id);
            if($reservas){
                $datos = Reservas::select('reservas.reserva_id','reserva.usuario_id','reservas.restaurante_id','reservas.fecha_reserva','reservas.numero_personas',
                'reservas.estado')
                ->join('usuarios','reservas.usuario_id','=','usuarios.usuarios_id')
                ->join('restaurantes','reservas.resaturante_id','=','restaurantes.restaurante_id')
                ->where('reservas.reserva_id','=', $reserva_id)
                ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Reserva no encontrada'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }
}
