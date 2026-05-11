<?php

use App\Modules\Project\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::prefix('projects')->group(function () {
    Route::get('featured',  [ProjectController::class, 'featured']);
    Route::get('/',         [ProjectController::class, 'index']);
    Route::get('{slug}',    [ProjectController::class, 'show']);



    Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {
        Route::get('/',         [ProjectController::class, 'adminIndex']);
        Route::post('/',        [ProjectController::class, 'store']);
        Route::get('{id}',      [ProjectController::class, 'adminShow']);
        Route::put('{id}',      [ProjectController::class, 'update']);
        Route::delete('{id}',   [ProjectController::class, 'destroy']);
    });
});
