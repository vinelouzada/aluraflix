<?php

use App\Http\Controllers\Api\CategoriasController;
use App\Http\Controllers\Api\VideosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get("/videos", [VideosController::class,'index']);
Route::get("/videos/{video}",[VideosController::class,'show']);
Route::post("/videos", [VideosController::class,'store']);
Route::match(['PUT', 'PATCH'],'/videos/{video}', [VideosController::class, 'update']);
Route::delete('/videos/{video}', [VideosController::class, 'destroy']);


Route::get("/categorias", [CategoriasController::class,'index']);
Route::post("/categorias",[CategoriasController::class,'store']);
Route::get("/categorias/{categoria}",[CategoriasController::class,'show']);
Route::match(['PUT','PATCH'], '/categorias/{categoria}',[CategoriasController::class,'update']);
Route::delete("/categorias/{categoria}",[CategoriasController::class,'destroy']);


Route::get("/categorias/{categoria}/videos",[CategoriasController::class,'search']);



