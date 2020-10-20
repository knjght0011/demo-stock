<?php

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

use App\Http\Controllers\StockProgressController;

Route::get('/', function () {
    return Voyager::view('voyager::login');
});



Route::group(['prefix' => 'admin'], function () {
    Route::get('/stock-progress/start-fetch-data/{id}', [StockProgressController::class,'startFetchData']);
    Route::get('/stock-progress/stop-fetch-data/{id}', [StockProgressController::class,'stopFetchData']);
    Route::get('/stock-progress/export-data-csv/{id}', [StockProgressController::class,'exportDataToCSV']);
    Voyager::routes();
});
