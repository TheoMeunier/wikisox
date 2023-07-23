<?php

use App\Http\Controllers\Api\ApiBookController;
use App\Http\Controllers\Api\ApiChapterController;
use App\Http\Controllers\Api\ApiPageController;
use App\Http\Controllers\Api\ApiProfileController;
use App\Http\Controllers\Api\Tools\ApiAuthController;

Route::middleware(['auth'])->prefix('/webapi')->group(function () {
    Route::controller(ApiBookController::class)->prefix('/books')->group(function () {
        Route::get('/{q?}', 'index');
        Route::post('/like/{book}', 'like');

        Route::controller(ApiChapterController::class)->prefix('/chapters/{slug}')->group(function () {
            Route::get('/{q?}', 'index');
            Route::post('/like/{chapter}', 'like');

            Route::controller(ApiPageController::class)->prefix('/pages/{slugChapter}')->group(function () {
                Route::get('/{q?}', 'index');
                Route::post('/like/{page}', 'like');
            });
        });
    });

    Route::controller(ApiChapterController::class)->prefix('/chapters')->group(function () {
        Route::post('/like/{chapter}', 'like');
    });

    Route::controller(ApiProfileController::class)->prefix('/profile')->group(function () {
        Route::put('/update', 'update');
        Route::put('/update/password', 'updatePassword');
        Route::get('/logs', 'logs');
    });

    Route::get('/auth', [ApiAuthController::class, 'index']);
});
