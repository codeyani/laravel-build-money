<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoneyController;

Route::get('/add-money', [MoneyController::class, 'addMoney']);
Route::get('/convert-amount', [MoneyController::class, 'convertAmount']);
Route::get('/subtract-money', [MoneyController::class, 'subtractMoney']);
Route::get('/multiply-money', [MoneyController::class, 'multiplyMoney']);
Route::get('/divide-money', [MoneyController::class, 'divideMoney']);
Route::get('/apply-discount', [MoneyController::class, 'applyDiscount']);


Route::get('/money/{id}', [MoneyController::class, 'getMoney']);
Route::post('/money', [MoneyController::class, 'createMoney']);
Route::put('/money/{id}', [MoneyController::class, 'updateMoney']);
Route::delete('/money/{id}', [MoneyController::class, 'deleteMoney']);
Route::get('/money', [MoneyController::class, 'getAllMoney']);

Route::get('/', function () {
    return view('welcome');
});
