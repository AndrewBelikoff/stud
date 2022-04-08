<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TestController;
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
    Route::get('/all', [StudentController::class, 'getAll']);   // 1)
    Route::post('/set', [StudentController::class, 'set']);     // 3, 4)
    Route::delete('/{id}', [StudentController::class, 'del']);  // 5)
    Route::get('/{id}', [StudentController::class, 'info']);    // 2)
});

Route::prefix('class')->group(function () {
    Route::any('/all', [GroupController::class, 'getAll']);
    Route::any('/set', [GroupController::class, 'set']);
    Route::any('/del', [GroupController::class, 'del']);
    Route::any('/info', [GroupController::class, 'info']);
});

Route::prefix('plan')->group(function () {
    Route::any('/info', [PlanController::class, 'getPlan']);
    Route::any('/set', [PlanController::class, 'set']);
});

Route::prefix('lecture')->group(function () {
    Route::any('/all', [LectureController::class, 'getAll']);
    Route::any('/set', [LectureController::class, 'set']);
    Route::any('/del', [LectureController::class, 'del']);
    Route::any('/info', [LectureController::class, 'info']);
});

Route::any('/test', [TestController::class, 'index']);
