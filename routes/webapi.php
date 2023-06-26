<?php

use App\Http\Controllers\Api\Admin\ApiAdminBookController;
use App\Http\Controllers\Api\Admin\ApiAdminChapterController;
use App\Http\Controllers\Api\Admin\ApiAdminLogController;
use App\Http\Controllers\Api\Admin\ApiAdminPageController;
use App\Http\Controllers\Api\Admin\ApiAdminUserController;
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

    Route::prefix('/admin')->group(function () {
        Route::get('/logs', [ApiAdminLogController::class, 'index']);

        Route::controller(ApiAdminBookController::class)->prefix('/books')->group(function () {
            Route::get('/{q?}', 'index');
            Route::delete('/delete/{slug}', 'delete');
        });

        Route::controller(ApiAdminChapterController::class)->prefix('/chapters')->group(function () {
            Route::get('/{q?}', 'index');
            Route::delete('/delete/{slug}', 'delete');
        });

        Route::controller(ApiAdminPageController::class)->prefix('/pages')->group(function () {
            Route::get('/{q?}', 'index');
            Route::delete('/delete/{slug}', 'delete');
        });

        Route::controller(ApiAdminUserController::class)->prefix('/users')->group(function () {
            Route::get('/{q?}', 'index');
            Route::delete('/delete/{user}', 'delete');
        });
    });

    Route::get('/auth', [ApiAuthController::class, 'index']);
});
