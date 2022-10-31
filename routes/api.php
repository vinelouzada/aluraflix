<?php

use App\Http\Controllers\Api\CategoriaController;
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


Route::get("/categorias", [CategoriaController::class,'index']);
Route::post("/categorias",[CategoriaController::class,'store']);
Route::get("/categorias/{categoria}",[CategoriaController::class,'show']);
Route::match(['PUT','PATCH'], '/categorias/{categoria}',[CategoriaController::class,'update']);
Route::delete("/categorias/{categoria}",[CategoriaController::class,'destroy']);


Route::get("/categorias/{categoria}/videos",[CategoriaController::class,'search']);



