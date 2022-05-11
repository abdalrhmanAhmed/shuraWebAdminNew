<?php

use App\Http\Controllers\Api\user\userController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\catiguriesServices\CatiguriesController;
use App\Http\Controllers\Api\catiguriesServices\ConsoleServicesController;
use App\Http\Controllers\Api\catiguriesServices\OrdersController;
use App\Http\Controllers\Api\catiguriesServices\TimeController;
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


/*
|--------------------------------------------------------------------------
| API Authentication Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});
/*
|--------------------------------------------------------------------------
| API Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/users',[userController::class,'index']);
    Route::get('/user/{id}',[userController::class,'show']);
    Route::post('/users',[userController::class,'store']);
    Route::post('/user/update/{id}',[userController::class,'update']);
    Route::post('/user/delete/{id}',[userController::class,'destroy']);
    #################### Catiguries and Services Routes ############################
    Route::post('/console/time',[TimeController::class,'consoleTime']) ;
    Route::post('/console/timeShow',[TimeController::class,'showConsoleTime']) ;
    Route::post('/console/timeDestroy',[TimeController::class,'consoleTimeDestroy']) ;
    Route::post('/console/load',[userController::class,'consoleLoad']) ;
    Route::post('/client/load',[userController::class,'clientLoad']) ;
    Route::get('/services/all',[ConsoleServicesController::class,'getServices']);
    Route::post('/console/service/store',[ConsoleServicesController::class,'store']);
    Route::post('/service/consoles',[ConsoleServicesController::class,'getConsoles']);
    Route::get('/user-wallet',[userController::class,'get_wallet']);

    Route::post('/orders/create',[OrdersController::class,'create']);
});
/*
|--------------------------------------------------------------------------
| API Unauthenticated Routes
|--------------------------------------------------------------------------
*/
Route::post('/categuries',[CatiguriesController::class,'getCatiguries']) ;
Route::post('/services',[CatiguriesController::class,'getServices']) ;


