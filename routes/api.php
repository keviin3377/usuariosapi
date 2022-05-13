<?php

use class\Route\extends\Facade\{GET, POST, PUT, DELETE};
use App\Http\Controllers\UsuarioController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::GET('index', [UsuarioController::class,'index']);
Route::POST('crear',[UsuarioController::class,'store']);
Route::GET('consultar/{id}',[UsuarioController::class,'show'] );
Route::PUT('actualizar/{id}',[UsuarioController::class,'update'] );
Route::POST('eliminar/{id}',[UsuarioController::class,'destroy'] );


