<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIDaftarRuangController;
use App\Http\Controllers\APIRentController;
use App\Http\Controllers\APIAuthController;
use App\Http\Controllers\RentController;

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
Route::post('register',[APIAuthController::class, 'register']);
Route::post('login',[APIAuthController::class, 'login']);

Route::get('daftarRuang',[APIDaftarRuangController::class, 'index']);
Route::get('daftarRuang/{id}',[APIDaftarRuangController::class, 'show']);
Route::apiResource('daftarPinjam', APIRentController::class);
// Route::get('daftarPinjam', [APIRentController::class, 'index']);
// Route::get('daftarPinjam/{id}', [APIRentController::class, 'show']);
// Route::post('daftarPinjam', [APIRentController::class, 'store']);
// Route::put('daftarPinjam/{id}', [APIRentController::class, 'update']);
// Route::delete('daftarPinjam/{id}', [APIRentController::class, 'destroy']);

Route::get('/api/schedule/today', [RentController::class, 'getTodaySchedule']);
Route::get('/api/schedule/upcoming', [RentController::class, 'getUpcomingSchedule']);
