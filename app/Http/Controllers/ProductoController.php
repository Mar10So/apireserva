<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductoController extends Controller
{
    //Enpoint Para el listado de producto
    public function select(){
        try{
            $producto = Producto::all();
            if($producto->count()>0){
                return response()->json([
                    'code'=>200,
                    'data'=>$producto
                ],200);
            }else{
                return response()->json([
                    'code'=>404,
                    'data'=>'No hay producto en la base de datos'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }
    /* Enpoint Para  insertar producto */
    public function insertar(Request $request){
        try{
            //Validar campos de la tabla producto
            $validacion = Validator::make($request->all(),[
                /* 'producto_id' => 'required', */
                'restaurante_id' => 'required',
                'categoria_id' => 'required',
                'menu_id' => 'required',
                'nombre' => 'required|string|max:255',
                'precio' => 'required|numeric',
                'descripcion' => 'required',
                'imagen' => 'required',
            ]);
            //Si la respuesta esta mala
            if($validacion -> fails()){
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $producto = Producto::create($request->all());
                return response()->json([
                    'code' => 200,
                    'data' => 'Producto Creado'
                ],200);
            }
        }catch (\Exception $e) {
            // Captura el error específico
            return response()->json([
                'code' => 500,
                'data' => 'Error al crear el producto: ' . $e->getMessage()
            ], 500);
        }
    }

    /* Endpoint para modificar producto */
    public function update(Request $request, $usuario_id){
        try{
            //validar campos requeridos
            $validacion = Validator::make($request->all(),[
                /* 'producto_id' => 'required', */
                'restaurante_id' => 'required',
                'categoria_id' => 'required',
                'menu_id' => 'required',
                'nombre' => 'required|string|max:255',
                'precio' => 'required|numeric',
                'descripcion' => 'required',
                'imagen' => 'required',
            ]);
            //su la respuesta esta mala 
            if($validacion -> fails()){
                return reponse()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $producto = Producto::find($producto_id);
                if($producto){
                    $producto->update($request->all());
                    return response()->json([
                    'code' => 200,
                    'data' => 'Producto Actulizado'
                    ],200);
                }else{
                    return response()->json([
                        'code' => 204,
                        'data' => 'Producto no encontrado'
                    ],204);
                }
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoint para eliminar producto */
    public function delete($producto_id){
        try{
            $producto = Producto::find($producto_id);
            if($producto){
                $producto->delete($producto_id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Producto Eliminado'
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Producto no encontrado'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoin para buscar producto */
    public function find($producto_id){
        try{
            //buscar producto
            $producto = Producto::find($producto_id);
            if($producto){
                $datos = Producto::select('producto.producto_id','producto.restaurante_id','producto.categoria_id','producto.menu_id','producto.nombre',
                'producto.precio','producto.descripcion','produccto.imagen')
                ->join('restaurantes','=','producto.restaurante_id','restaurantes.restaurante_id')
                ->join('categorias','=','producto.categoria_id','categorias.categorias_id')
                ->join('menus','=','producto.menus_id','menus.menu_id')
                ->where('producto.producto_id','=', $producto_id)
                ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Producto no encontrado'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }
}
