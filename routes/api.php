<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\KlassController;
use App\Http\Controllers\Api\V1\StudentController;
use App\Http\Controllers\Api\V1\LectureController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    //Student Routes
    Route::apiResource('students', StudentController::class);
    Route::group(['prefix' => 'students/{student}'], function () {
        Route::post('add-lectures', [StudentController::class, 'addLectures']);
    });

    Route::apiResource('klasses', KlassController::class);

    Route::apiResource('lectures', LectureController::class);
});
