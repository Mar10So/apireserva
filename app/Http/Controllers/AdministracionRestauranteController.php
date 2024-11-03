<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administracion_Restaurante;
use Illuminate\Support\Facades\Validator;

class AdministracionRestauranteController extends Controller
{
    // Endpoint para el listado de administradores de restaurantes
    public function select()
    {
        try {
            $administrador = Administracion_Restaurante::all();
            if ($administrador->count() > 0) {
                return response()->json([
                    'code' => 200,
                    'data' => $administrador
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay administradores en la base de datos'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para insertar administradores
    public function insertar(Request $request)
    {
        try {
            $validacion = Validator::make($request->all(), [
                'nombre_usuario' => 'required',
                'email' => 'required|email',
                'pasword' => 'required',
                'rol' => 'required',
            ]);
            if ($validacion->fails()) {
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                Administracion_Restaurante::create($request->all());
                return response()->json([
                    'code' => 200,
                    'data' => 'Administrador Creado'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para modificar administradores
    public function update(Request $request, $admin_id)
    {
        try {
            $validacion = Validator::make($request->all(), [
                'nombre_usuario' => 'required',
                'email' => 'required|email',
                'pasword' => 'required',
                'rol' => 'required',
            ]);
            if ($validacion->fails()) {
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                $administrador = Administracion_Restaurante::find($admin_id);
                if ($administrador) {
                    $administrador->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Administrador Actualizado'
                    ], 200);
                } else {
                    return response()->json([
                        'code' => 404,
                        'data' => 'Administrador no encontrado'
                    ], 404);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para eliminar administradores
    public function delete($admin_id)
    {
        try {
            $administrador = Administracion_Restaurante::find($admin_id);
            if ($administrador) {
                $administrador->delete();
                return response()->json([
                    'code' => 200,
                    'data' => 'Administrador Eliminado'
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'data' => 'Administrador no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para buscar administradores
    public function find($admin_id)
    {
        try {
            $administrador = Administracion_Restaurante::find($admin_id);
            if ($administrador) {
                return response()->json([
                    'code' => 200,
                    'data' => $administrador
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'data' => 'Administrador no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para buscar administradores (duplicado, podrías considerar eliminar uno)
    public function find2($admin_id)
    {
        return $this->find($admin_id); // Simplificando el método
    }
}
