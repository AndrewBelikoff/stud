<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\StudentController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('student')->group(function () {
    Route::any('/all', [StudentController::class, 'getAll']);
    Route::any('/set/{s}', [StudentController::class, 'set']);
    Route::any('/del/{s}', [StudentController::class, 'del']);
    Route::any('/info/{s}', [StudentController::class, 'info']);
});

Route::prefix('class')->group(function () {
    Route::any('/all', [GroupController::class, 'getAll']);
    Route::any('/set/{s}', [GroupController::class, 'set']);
    Route::any('/del/{s}', [GroupController::class, 'del']);
    Route::any('/info/{s}', [GroupController::class, 'info']);
});

Route::prefix('plan')->group(function () {
    Route::any('/info/{c}', [PlanController::class, 'getPlan']);
    Route::any('/set/{s}', [PlanController::class, 'set']);
});

Route::prefix('lecture')->group(function () {
    Route::any('/all', [LectureController::class, 'getAll']);
    Route::any('/set/{s}', [LectureController::class, 'set']);
    Route::any('/del/{s}', [LectureController::class, 'del']);
    Route::any('/info/{s}', [LectureController::class, 'info']);
});
