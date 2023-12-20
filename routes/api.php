<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyExchangeController;
use App\Http\Controllers\LoginController;





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

Route::group(['middleware' => 'cors'], function () {
    // login 
    Route::post('login', [LoginController::class, 'login']);

    // CurrencyExchangeController routes
    Route::get('/weekly-exchange-rates/{selectedDate}/{currency}', [CurrencyExchangeController::class, 'getWeeklyExchangeRates']);
    Route::post('/store-data', [CurrencyExchangeController::class, 'store']);
    Route::get('/list-all', [CurrencyExchangeController::class, 'listAll']);
    
});
