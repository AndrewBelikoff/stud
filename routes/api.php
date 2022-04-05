<?php

use Illuminate\Http\Request;
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

Route::get('/{i}', function ($i) {
    return 'bl ' . $i;
});
Route::prefix('student')->group(function () {
    Route::get('/all', function () {
        return '1) получить список всех студентов';
    });
    Route::get('/make', function () {
        return '3) создать студента';
    });
    Route::get('/refresh', function () {
        return '4) обновить студента (имя, принадлежность к классу)';
    });
    Route::get('/del', function () {
        return '5) удалить студента';
    });
    Route::get('/{s}', function ($s) {
        return '2) получить информацию о конкретном студенте (имя, email + класс + прослушанные лекции): ' . $s;
    });
});

Route::prefix('class')->group(function () {
    Route::get('/all', function () {
        return '6) получить список всех классов';
    });
    Route::get('/make', function () {
        return '10) создать класс';
    });
    Route::get('/refresh', function () {
        return '11) обновить класс (название)';
    });
    Route::get('/del', function () {
        return '12) удалить класс (при удалении класса, привязанные студенты должны открепляться от класса, но не удаляться полностью из системы)';
    });
    Route::get('/{s}', function ($s) {
        return '7) получить информацию о конкретном классе (название + студенты класса): ' . $s;
    });
});

Route::prefix('plan')->group(function () {
    Route::get('/class/{c}', function ($c) {
        return '8) получить учебный план (список лекций) для конкретного класса ' . $c;
    });
    Route::get('/refresh/{s}', function ($s) {
        return '9) создать/обновить учебный план (очередность и состав лекций) для конкретного класса: ' . $s;
    });
});

Route::prefix('lecture')->group(function () {
    Route::get('/all', function () {
        return '13) получить список всех лекций';
    });
    Route::get('/make', function () {
        return '15) создать лекцию';
    });
    Route::get('/del', function () {
        return '17) удалить лекцию';
    });
    Route::get('/refresh/{l}', function ($l) {
        return '16) обновить лекцию (тема, описание)' . $l;
    });
});
