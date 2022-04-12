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
    Route::get('/all', [GroupController::class, 'getAll']);     // 6)
    Route::post('/set', [GroupController::class, 'set']);       // 10, 11)
    Route::delete('/{id}', [GroupController::class, 'del']);    // 12
    Route::get('/{id}', [GroupController::class, 'info']);      // 7)
});

Route::prefix('plan')->group(function () {
    Route::get('/{id}', [PlanController::class, 'getPlan']);    // 8)
    Route::post('/set', [PlanController::class, 'set']);        // 9)
});

Route::prefix('lecture')->group(function () {
    Route::get('/all', [LectureController::class, 'getAll']);   // 13)
    Route::post('/set', [LectureController::class, 'set']);     // 15, 16)
    Route::delete('/{id}', [LectureController::class, 'del']);  // 17)
    Route::get('/{id}', [LectureController::class, 'info']);    // 14)
});

Route::any('/test', [TestController::class, 'index']);
