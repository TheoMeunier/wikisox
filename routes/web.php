<?php

use App\Http\Controllers\Api\ApiBookController;
use App\Http\Controllers\Api\ApiChapterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::controller(ChapterController::class)->prefix('/chapter')->name('chapter.')->group(function () {
        Route::post('/{slug}/edit', 'update')->name('update');
    });

    Route::controller(BookController::class)->prefix('/books')->name('book.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/{slug}/edit', 'edit')->name('edit');
        Route::post('/{slug}/edit', 'update')->name('update');

        Route::controller(ChapterController::class)->prefix('/{slug}')->name('chapter.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{slugChapter}/edit', 'edit')->name('edit');
        });
    });

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Api local
Route::middleware(['auth'])->prefix('/webapi')->group(function () {
    Route::controller(ApiBookController::class)->prefix('/books')->group(function () {
        Route::get('/{q?}', 'index');
        Route::post('/like/{book}', 'like');
        Route::delete('/delete/{book}', 'delete');

        Route::controller(ApiChapterController::class)->prefix('/chapters/{slug}')->group(function () {
            Route::get('/{q?}', 'index');
            Route::post('/like/{chapter}', 'like');
            Route::delete('/delete/{chapter}', 'delete');
        });
    });

    Route::controller(ApiChapterController::class)->prefix('/pages')->group(function () {
        Route::get('/{q?}', 'index');
        Route::post('/like/{pages}', 'like');
        Route::delete('/delete/{pages}', 'delete');
    });
});



