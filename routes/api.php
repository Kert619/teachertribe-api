<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\GetUserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProblemController;
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

    Route::apiResource('/exam-types', ExamTypeController::class);
    Route::apiResource('/problem-types', ProblemTypeController::class);
    Route::apiResource('/problems', ProblemController::class);
    Route::apiResource('/assessments', AssessmentController::class);
    Route::apiResource('/groups', GroupController::class);

    Route::prefix('/problem-types')->group(function(){
        Route::get('/{examType}/get-all-by-exam-type-id', [ProblemTypeController::class, 'getAllByExamTypeId']);
    });

    Route::prefix('/problems')->group(function(){
        Route::get('/{problemType}/get-all-by-problem-type-id', [ProblemController::class, 'getAllByProblemTypeId']);
    });

    Route::prefix('/assessments')->group(function(){
        Route::post('/check-existing-assessment-title', [AssessmentController::class, 'checkExistingAssessmentTitle']);
    });



    Route::post('logout', LogoutController::class);
});
