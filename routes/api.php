<?php

use App\Http\Controllers\Api\user\userController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\catiguriesServices\CatiguriesController;
use App\Http\Controllers\Api\catiguriesServices\ConsoleServicesController;
use App\Http\Controllers\Api\catiguriesServices\OrdersController;
use App\Http\Controllers\Api\catiguriesServices\TimeController;
use App\Http\Controllers\Api\console\consoleController;
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
    Route::post('/consoleRegister', [AuthController::class, 'consoleRegister']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/create_otp', [AuthController::class, 'verficationCode']);
    Route::post('/check_otp', [AuthController::class, 'checkOTP']);
    Route::post('/change_password', [AuthController::class, 'changePassword']);
    Route::post('/image', [AuthController::class, 'image']);

    Route::post('/updateProfile', [consoleController::class, 'updateProfile']);
});
/*
|--------------------------------------------------------------------------
| API Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/user',[userController::class,'index']);
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
    Route::get('/user-wallet',[userController::class,'get_wallet']);
    Route::get('/services/all',[ConsoleServicesController::class,'getServices']);
    Route::post('/console/service/store',[ConsoleServicesController::class,'store']);
    Route::post('/service/consoles',[ConsoleServicesController::class,'getConsoles']);
    
    Route::post('/console/orders',[OrdersController::class,'get_console_orders']);
    Route::post('/client/orders',[OrdersController::class,'get_client_orders']);
    Route::post('/orders/create',[OrdersController::class,'create']);
    Route::post('/orders/confirm',[OrdersController::class,'confirm_order']);
    Route::post('/orders/reject',[OrdersController::class,'reject_order']);
});
/*
|--------------------------------------------------------------------------
| API Unauthenticated Routes
|--------------------------------------------------------------------------
*/
Route::post('/categuries',[CatiguriesController::class,'getCatiguries']) ;
Route::post('/services',[CatiguriesController::class,'getServices']) ;


