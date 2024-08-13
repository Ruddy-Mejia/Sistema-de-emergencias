<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario\UserController;

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
 Route::get('userall', [UserController::class, 'index']);
 Route::post('userregister', [UserController::class, 'store']);
 Route::get('userfind/{id}', [UserController::class, 'show']);
 Route::put('userupdate/{id}', [UserController::class, 'update']);
 Route::delete('userdelete/{id}', [UserController::class, 'delete']);
 Route::get('usercreate', [UserController::class, 'create']);
 Route::get('useredit', [UserController::class, 'edit']);
 
