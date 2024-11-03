<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Para Registrar Los usuarios
    public function register(Request $request){
        try {
            $validacion = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'rol' => 'required|in:superadmin,admin,user', // Asignar un rol
            ]);

            if ($validacion->fails()) {
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Crear el usuario
                $usuario = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password, // Se usará el mutador
                    'rol' => $request->rol,
                ]);

                return response()->json([
                    'code' => 200,
                    'data' => $usuario,
                    'token' => $usuario->createToken('api-key')->plainTextToken
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


    //EndPoint para validar login
    public function login(Request $request){
        try {
            $validacion = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validacion->fails()) {
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                if (Auth::attempt([
                    'email' => $request->email,
                    'password' => $request->password
                ])) {
                    $usuario = Auth::user(); // Obtiene el usuario autenticado
                    $rol = $usuario->rol; // Obtiene el rol del usuario

                    return response()->json([
                        'code' => 200,
                        'data' => [
                            'user' => $usuario,
                            'rol' => $rol, // Devuelve el rol
                        ],
                        'token' => $usuario->createToken('api-key')->plainTextToken
                    ], 200);
                } else {
                    return response()->json([
                        'code' => 401,
                        'data' => 'Usuario no autorizado'
                    ], 401);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


}
