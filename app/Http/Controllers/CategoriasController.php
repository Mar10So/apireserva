<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Focades\Validator;
use App\Models\Categorias;

class CategoriasController extends Controller
{
    ////Enpoint Para el listado categorias
    public function select(){
        try{
            $categorias = Categorias::all();
            if($categorias->count()>0){
                return response()->json([
                    'code'=>200,
                    'data'=>$categorias
                ],200);
            }else{
                return response()->json([
                    'code'=>404,
                    'data'=>'No hay categorias en la base de datos'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }
    /* Enpoint Para  insertar categorias */
    public function insertar(Request $request){
        try{
            //Validar campos de la tabla categorias
            $validacion = Validator::make($request->all(),[
                'categoria_id' => 'required',
                'nombre' => 'required',
                'descripcion' => 'required',
            ]);
            //Si la respuesta esta mala
            if($validacion -> fails()){
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $categorias = Categorias::create($request->all());
                return response()->json([
                    'code' => 200,
                    'data' => 'Categoria Creado'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoint para modificar categoria */
    public function update(Request $request, $usuario_id){
        try{
            //validar campos requeridos
            $validacion = Validator::make($request->all(),[
                'categoria_id' => 'required',
                'nombre' => 'required',
                'descripcion' => 'required',
            ]);
            //su la respuesta esta mala 
            if($validacion -> fails()){
                return reponse()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $categorias = Categorias::find($categoria_id);
                if($categorias){
                    $categorias->update($request->all());
                    return response()->json([
                    'code' => 200,
                    'data' => 'categoria Actulizada'
                    ],200);
                }else{
                    return response()->json([
                        'code' => 204,
                        'data' => 'Categoria no encontrada'
                    ],204);
                }
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoint para eliminar Categoria */
    public function delete($categoria_id){
        try{
            $categorias = Categorias::find($categoria_id);
            if($categorias){
                $categorias->delete($categoria_id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Categoria Eliminada'
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Categoria no encontrada'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoin para buscar categoria */
    public function find($id){
        try{
            //buscar categoria
            $categorias= Categorias::find($categoria_id);
            if($categorias){
                $datos = Categorias::select('categorias.categoria_id','categorias.nombre','categorias.descripcion')
                ->where('categorias.categoria_id','=', $categoria_id)
                ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Categoria no encontrada'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

}
