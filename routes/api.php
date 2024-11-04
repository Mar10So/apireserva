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
use App\Http\Controllers\UserController;


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

    Route::middleware('auth:sanctum')->group (function () { // De esta manera estan seguras las rutas de mi api
 
    });
        //Rutas para los restaurantes
        Route::get('/restaurantes/select',[RestauranteController::class,'select']);
        Route::post('/restaurantes/insertar',[RestauranteController::class,'insertar']);
        Route::put('/restaurantes/update/{restaurante_id}',[RestauranteController::class,'update']);
        Route::delete('/restaurantes/delete/{restaurante_id}',[RestauranteController::class,'delete']);
        Route::get('/restaurantes/find2/{restaurante_id}',[RestauranteController::class,'find2']);
        Route::get('/restaurantes/find/{restaurante_id}',[RestauranteController::class,'find']);


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
        Route::put('/producto/update/{producto_id}',[ProductoController::class,'update']);
        Route::delete('/producto/delete/{producto_id}',[ProductoController::class,'delete']);
        Route::get('/producto/find2/{producto_id}',[ProductoController::class,'find2']);
        Route::get('/producto/find/{producto_id}',[ProductoController::class,'find']);

//gestionar Usuarios
Route::post('/usuario/register',[UserController::class,'register']);
Route::post('/usuario/login',[UserController::class,'login']);