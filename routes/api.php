<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\CalificacionesController;
use App\Http\Controllers\AdministracionRestauranteController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Rutas para clientes
Route::get('/usuarios/select',[UsuariosController::class,'select']);
Route::post('/usuario/insertar',[UsuariosController::class,'insertar']);
Route::put('/usuario/update/{usuario_id}',[UsuariosController::class,'update']);
Route::delete('/usuario/delete',[UsuariosController::class,'delete']);
Route::get('/usuario/find{usuario_id}',[UsuariosController::class,'find']);

//Rutas para administrador de restaurantes
Route::get('/administrador/select',[AdministracionRestauranteController::class,'select']);
Route::post('/administrador/insertar',[AdministracionRestauranteController::class,'insertar']);
Route::put('/administrador/update/{admin_id}',[AdministracionRestauranteController::class,'update']);
Route::delete('/administrador/delete',[AdministracionRestauranteController::class,'delete']);
Route::get('/administrador/find{admin_id}',[AdministracionRestauranteController::class,'find']);


//Rutas para los restaurantes
Route::get('/restaurantes/select',[RestauranteController::class,'select']);
Route::post('/restaurantes/insertar',[RestauranteController::class,'insertar']);
Route::put('/restaurantes/update/{restaurnate_id}',[RestauranteController::class,'update']);
Route::delete('/restaurantes/delete',[RestauranteController::class,'delete']);
Route::get('/restaurantes/find{restaurante_id}',[RestauranteController::class,'find']);


//Rutas para reservas
Route::get('/reservas/select',[ReservasController::class,'select']);
Route::post('/reservas/insertar',[ReservasController::class,'insertar']);
Route::put('/reservas/update/{restaurnate_id}',[ReservasController::class,'update']);
Route::delete('/reservas/delete',[ReservasController::class,'delete']);
Route::get('/reservas/find{restaurante_id}',[ReservasController::class,'find']);


//Rutas para menus
Route::get('/menus/select',[MenusController::class,'select']);
Route::post('/menus/insertar',[MenusController::class,'insertar']);
Route::put('/menus/update/{restaurnate_id}',[MenusController::class,'update']);
Route::delete('/menus/delete',[MenusController::class,'delete']);
Route::get('/menus/find{restaurante_id}',[MenusController::class,'find']);


//Rutas para Calificaciones
Route::get('/calificaciones/select',[CalificacionesController::class,'select']);
Route::post('/calificaciones/insertar',[CalificacionesController::class,'insertar']);
Route::put('/calificaciones/update/{restaurnate_id}',[CalificacionesController::class,'update']);
Route::delete('/calificaciones/delete',[CalificacionesController::class,'delete']);
Route::get('/calificaciones/find{restaurante_id}',[CalificacionesController::class,'find']);


//Rutas Para las categorias
Route::get('/categorias/select',[CategoriasController::class,'select']);
Route::post('/categorias/insertar',[CategoriasController::class,'insertar']);
Route::put('/categorias/update/{nombre}',[CategoriasController::class,'update']);
Route::delete('/categorias/delete',[CategoriasController::class,'delete']);
Route::get('/categorias/find{nombre}',[CategoriasController::class,'find']);


//Rutas para los productos
Route::get('/producto/select',[ProductoController::class,'select']);
Route::post('producto/insertar',[ProductoController::class,'insertar']);
Route::put('/producto/update/{id_producto}',[ProductoController::class,'update']);
Route::delete('/producto/delete',[ProductoController::class,'delete']);
Route::get('/producto/find{id_producto}',[ProductoController::class,'find']);