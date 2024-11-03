<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurante;
use Illuminate\Support\Facades\Validator;

class RestauranteController extends Controller
{
    //Enpoint Para el listado de restaurantes
    public function select(){
        try{
            $restaurantes = Restaurante::all();
            if($restaurantes->count()>0){
                return response()->json([
                    'code'=>200,
                    'data'=>$restaurantes
                ],200);
            }else{
                return response()->json([
                    'code'=>404,
                    'data'=>'No hay restaurantes en la base de datos'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }
    /* Enpoint Para  insertar nuevo restaurante */
    public function insertar(Request $request){
        try{
            //Validar campos de la tabla restaurantes
            $validacion = Validator::make($request->all(),[
                /* 'restaurante_id' => 'required', */
                'admin_id' => 'required',
                'nombre' => 'required',
                'direccion' => 'required',
                'ciudad' => 'required',
                'tipo_cocina' => 'required',
                'rango_precios' => 'required',
                'capacidad' => 'required',
                'horario_apertura' => 'required',
                'horario_cierre' => 'required',
                'email' => 'required',
                'telefono' => 'required',
                'imagen' => 'required',
            ]);
            //Si la respuesta esta mala
            if($validacion -> fails()){
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $restaurantes = Restaurante::create($request->all());
                return response()->json([
                    'code' => 200,
                    'data' => 'Restaurante Creado'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }


/* Endpoint para modificar Restaurante */
public function update(Request $request, $restaurante_id){
    try {
        // Validar campos requeridos
        $validacion = Validator::make($request->all(), [
            'admin_id' => 'required',
            'nombre' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'tipo_cocina' => 'required',
            'rango_precios' => 'required',
            'capacidad' => 'required|integer',
            'horario_apertura' => 'required',
            'horario_cierre' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'imagen' => 'required',
        ]);

        if ($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        }

        // Buscar el restaurante por ID
        $restaurante = Restaurante::where('restaurante_id', $restaurante_id)->first();

        if ($restaurante) {
            $restaurante->update($request->all());
            return response()->json([
                'code' => 200,
                'data' => 'Restaurante actualizado'
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data' => 'Restaurante no encontrado'
            ], 404);
        }
    } catch (\Throwable $th) {
        return response()->json([
            'code' => 500,
            'data' => 'Error en la modificación: ' . $th->getMessage()
        ], 500);
    }
}



    /* Endpoint para eliminar Restaurante */
    public function delete($restaurante_id){
        try{
            $restaurantes = Restaurante::find($restaurante_id);
            if($restaurantes){
                $restaurantes->delete($restaurante_id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Restuarnte Eliminado'
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Restaurante no encontrado'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }


    //Metodo para buscar restaurante por id 
    public function find2($restaurante_id) {
        try {
            // buscar restaurante
            $restaurante = Restaurante::where('restaurante_id', $restaurante_id)->first(); // Usa la clave primaria correcta
            if ($restaurante) {
                $datos = Restaurante::select(
                    'restaurantes.restaurante_id',
                    'restaurantes.admin_id',
                    'restaurantes.nombre',
                    'restaurantes.direccion',
                    'restaurantes.ciudad',
                    'restaurantes.tipo_cocina',
                    'restaurantes.rango_precios',
                    'restaurantes.capacidad',
                    'restaurantes.horario_apertura',
                    'restaurantes.horario_cierre',
                    'restaurantes.email',
                    'restaurantes.telefono',
                    'restaurantes.imagen'
                )
                ->join('administracion_restaurante', 'restaurantes.admin_id', '=', 'administracion_restaurante.admin_id')
                ->where('restaurantes.restaurante_id', '=', $restaurante_id)
                ->first(); 
    
                return response()->json([
                    'code' => 200,
                    'data' => $datos
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'data' => 'Restaurante no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
    

    /* Endpoin para buscar restaurante */
    public function find($restaurante_id) {
        try {
            // buscar restaurante
            $restaurante = Restaurante::where('restaurante_id', $restaurante_id)->first(); // Usa la clave primaria correcta
            if ($restaurante) {
                $datos = Restaurante::select(
                    'restaurantes.restaurante_id',
                    'restaurantes.admin_id',
                    'restaurantes.nombre',
                    'restaurantes.direccion',
                    'restaurantes.ciudad',
                    'restaurantes.tipo_cocina',
                    'restaurantes.rango_precios',
                    'restaurantes.capacidad',
                    'restaurantes.horario_apertura',
                    'restaurantes.horario_cierre',
                    'restaurantes.email',
                    'restaurantes.telefono',
                    'restaurantes.imagen'
                )
                ->join('administracion_restaurante', 'restaurantes.admin_id', '=', 'administracion_restaurante.admin_id')
                ->where('restaurantes.restaurante_id', '=', $restaurante_id)
                ->first(); 
    
                return response()->json([
                    'code' => 200,
                    'data' => $datos
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'data' => 'Restaurante no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
    
}
