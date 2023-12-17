<?php

use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\GetUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProblemTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', LoginController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', GetUserController::class);

    Route::apiResource('/exam-type', ExamTypeController::class);
    Route::apiResource('/problem-type', ProblemTypeController::class);

    Route::post('logout', LogoutController::class);
});
