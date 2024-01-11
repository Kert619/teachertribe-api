<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AssessmentExamineeController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\FinishTestController;
use App\Http\Controllers\GetUserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\JDoodleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\ProblemTypeController;
use App\Http\Controllers\UpdateExamineeDetailsController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\VerifyPinController;
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

Route::post('/verify-pin', [VerifyPinController::class, 'verifyPin']);
Route::get('/fetch-pin', [VerifyPinController::class, 'fetchPin']);

Route::middleware('verify-pin')->group(function () {
    Route::post('/execute-code', JDoodleController::class);
    Route::put('/update-examinee-details', UpdateExamineeDetailsController::class);


    Route::get('/answers', [AnswerController::class, 'index']);
    Route::post('/answers', [AnswerController::class, 'submitAnswer']);
    Route::get('/answers/getByAssessmentExamineeIdAndProblemId', [AnswerController::class, 'getByAssessmentExamineeIdAndProblemId']);
    Route::get('/answers/{assessmentExaminee}', [AnswerController::class, 'show']);
    Route::put('/finish-test/{assessmentExaminee}', FinishTestController::class);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', GetUserController::class);
    Route::put('/update-user/{user}', UpdateUserController::class);

    Route::apiResource('/exam-types', ExamTypeController::class);
    Route::apiResource('/problem-types', ProblemTypeController::class);
    Route::apiResource('/problems', ProblemController::class);
    Route::apiResource('/assessments', AssessmentController::class);
    Route::apiResource('/groups', GroupController::class);
    Route::apiResource('/assessment-examinees', AssessmentExamineeController::class);

    Route::prefix('/problem-types')->group(function () {
        Route::get('/{examType}/get-all-by-exam-type-id', [ProblemTypeController::class, 'getAllByExamTypeId']);
    });

    Route::prefix('/problems')->group(function () {
        Route::get('/{problemType}/get-all-by-problem-type-id', [ProblemController::class, 'getAllByProblemTypeId']);
    });

    Route::prefix('/assessments')->group(function () {
        Route::post('/check-existing-assessment-title', [AssessmentController::class, 'checkExistingAssessmentTitle']);
    });



    Route::post('logout', LogoutController::class);
});
