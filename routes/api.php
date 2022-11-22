<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use App\Http\Controllers\HealthController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([],function (Router $router){
    $router->post('/user/login',[UserController::class,'login']);
    $router->get('/health/ping',[HealthController::class,'ping']);
});

Route::group([
    'middleware'=> ['jwt.auth.catch','jwt.auth']
],function (Router $router){
    $router->get('/user/info',[UserController::class,'info']);
});


