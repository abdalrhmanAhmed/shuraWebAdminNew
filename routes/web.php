<?php

use App\Events\MessagesEvent;
use App\Http\Controllers\transactions\transactionsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
// testing puser events
Route::get('/message', function () {
    return event(new MessagesEvent('test event'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

#############################users Route####################################
Route::controller(App\Http\Controllers\user\userController::class)->group(function(){
    Route::get('/user', 'index')->name('user');
    Route::post('/user/store', 'store')->name('user.store');
    Route::post('/user/destroy', 'destroy')->name('user.destroy');
    Route::post('/user/update', 'update')->name('user.update');
    Route::get('/user/show/{id}', 'show')->name('user.show');
    Route::get('/user/profile', 'profile')->name('user.profile');
});

#############################console Route####################################
Route::controller(App\Http\Controllers\console\consoleController::class)->group(function(){
    Route::get('/consoles', 'index')->name('consoles');
    Route::post('/consoles/store', 'store')->name('console.store');
    Route::get('getServices/{id}', 'getServices')->name('getServices');
});

#############################Catiguries Route############################
Route::controller(App\Http\Controllers\catiguries\CatiguriesController::class)->group(function(){
    Route::get('catiguries', 'index')->name('catiguries');
    Route::post('catiguries/store', 'store')->name('catiguries.store');
    Route::post('catiguries/update', 'update')->name('catiguries.update');
    Route::post('catiguries/delete', 'destroy')->name('catiguries.delete');
});

############################services routes###############################
Route::controller(App\Http\Controllers\services\servicesController::class)->group(function(){
    Route::get('services/services', 'index')->name('services');
    Route::post('services/store', 'store')->name('services.store');
    Route::post('services/update', 'update')->name('services.update');
    Route::post('services/delete', 'destroy')->name('services.delete');
});

############################Wallet routes###############################
Route::controller(App\Http\Controllers\wallet\WalletController::class)->group(function(){
    Route::get('wallet/wallet', 'index')->name('wallet');
    Route::post('wallet/delete', 'destroy')->name('wallet.delete');
    Route::post('wallet/update', 'update')->name('wallet.update');
    Route::get('wallet/archive', 'archive')->name('wallet.archive');
    Route::post('wallet/restore', 'restore')->name('wallet.restore');
});
############################Settings routes###############################

Route::controller(App\Http\Controllers\user\SettingsController::class)->group(function(){
    Route::get('settings/dark_mode_on', 'dark_mode_on')->name('settings.dark_mode_on');
    Route::get('settings/dark_mode_off', 'dark_mode_off')->name('settings.dark_mode_off');

});
############################feed Wallet routes###############################
Route::controller(App\Http\Controllers\wallet\feedController::class)->group(function(){
    Route::get('wallet/feed_wallet', 'index')->name('feed_wallet');
    Route::post('wallet/feed_wallet/store', 'store')->name('store_wallet');
    Route::post('wallet/feed_wallet/update/{id}', 'update')->name('update_wallet');
    Route::post('wallet/feed_wallet/delete/{id}', 'destroy')->name('delete_wallet');
});

############################transactions routes###############################
Route::controller(transactionsController::class)->group(function(){
    Route::get('transactions', 'index')->name('transactions');
    
});

Route::get('cp/{page}', [App\Http\Controllers\AdminController::class, 'index']);

