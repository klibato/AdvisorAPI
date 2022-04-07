<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*------------------------------- User -------------------------------- */

Route::get('users', [UserController::class, 'index']);
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [UserController::class, 'logout']);
});
// Route::get('user/{id}', [UserController::class, 'show']);

/*-------------------------------- Restaurant --------------------------------*/

Route::get('restaurants', [RestaurantController::class, 'index']);
Route::post('restaurant', [RestaurantController::class, 'store']);
Route::put('restaurant/{id}', [RestaurantController::class, 'update']);
Route::delete('restaurant/{id}', [RestaurantController::class, 'destroy']);

/*--------------------------------- Menus ----------------------------------- */

Route::get('restaurant/{id}/menus', [MenuController::class, 'index']);
Route::post('restaurant/{id}/menu', [MenuController::class, 'create']);
Route::put('/restaurant/{restaurantId}/menu/{menuId}', [MenuController::class, 'update']);
Route::delete('/restaurant/{restaurantId}/menu/{menuId}', [MenuController::class, 'destroy']);

/*----------------------------------- Trombi --------------------------------- */

// Route::prefix('/user')->group( function(){
//     Route::post('/login', [AuthController::class, 'authenticate']); 
//     Route::middleware('auth:api')->get('/users', function(Request $request) {
//         return $request->user();
//     });
// });

// Route::get('photo', [AuthController::class, 'authenticate']); 


// Route::get('cookie/set', [AuthController::class, 'setCookie']); 
// Route::get('cookie/get', [AuthController::class, 'getCookie']);
