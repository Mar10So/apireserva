<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenusController extends Controller
{
    //Enpoint Para el listado de Menus
    public function select(){
        try{
            $menus = Menus::all();
            if($menus->count()>0){
                return response()->json([
                    'code'=>200,
                    'data'=>$menus
                ],200);
            }else{
                return response()->json([
                    'code'=>404,
                    'data'=>'No hay Menu en la base de datos'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }
    /* Enpoint Para  insertar Menu */
    public function insertar(Request $request){
        try{
            //Validar campos de la tabla Menus
            $validacion = Validator::make($request->all(),[
                'menu_id' => 'required',
                'restaurante_id' => 'required',
                'catgoria_id' => 'required',
                'nombre' => 'required',
            ]);
            //Si la respuesta esta mala
            if($validacion -> fails()){
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $menus = Menus::create($request->all());
                return response()->json([
                    'code' => 200,
                    'data' => 'Menu no creado Creado'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoint para modificar Menus */
    public function update(Request $request, $menu_id){
        try{
            //validar campos requeridos
            $validacion = Validator::make($request->all(),[
                'menu_id' => 'required',
                'restaurante_id' => 'required',
                'catgoria_id' => 'required',
                'nombre' => 'required',
            ]);
            //su la respuesta esta mala 
            if($validacion -> fails()){
                return reponse()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ],400);
            }else{
                $menus = Menus::find($menu_id);
                if($menus){
                    $menus->update($request->all());
                    return response()->json([
                    'code' => 200,
                    'data' => 'Menu Actulizado'
                    ],200);
                }else{
                    return response()->json([
                        'code' => 204,
                        'data' => 'Menu no encontrado'
                    ],204);
                }
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoint para eliminar Menus */
    public function delete($menu_id){
        try{
            $menus = Menus::find($menu_id);
            if($menus){
                $menus->delete($menu_id);
                return response()->json([
                    'code' => 200,
                    'data' => 'menu Eliminado'
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Menu no encontrado'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }

    /* Endpoin para buscar Menus */
    public function find($menu_id){
        try{
            //buscar Menu
            $menus = Menu::find($menu_id);
            if($menus){
                $datos = Menus::select('menus.menu_id','menus.restaurante_id','menus.categoria_id','menus.nombre')
                ->join('restaurantes','restaurantes.restaurante_id','=','menus.restaurante_id')
                ->join('categorias','categorias.categoria_id','=','menus.categoria_id')
                ->where('menus.menu_id','=', $menu_id)
                ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ],200);
            }else{
                return response()->json([
                    'code' => 404,
                    'data' => 'Menu no encontrado'
                ],404);
            }
        }catch(\Throwable $th){
            return response()->json($th->getMessage(),500);
        }
    }
}
