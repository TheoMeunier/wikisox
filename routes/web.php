<?php

use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminChapterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminlogController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Api\Admin\ApiAdminBookController;
use App\Http\Controllers\Api\Admin\ApiAdminChapterController;
use App\Http\Controllers\Api\Admin\ApiAdminLogController;
use App\Http\Controllers\Api\Admin\ApiAdminPageController;
use App\Http\Controllers\Api\ApiBookController;
use App\Http\Controllers\Api\ApiChapterController;
use App\Http\Controllers\Api\ApiPageController;
use App\Http\Controllers\Api\Tools\ApiTransController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\PageController;
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

    Route::controller(PageController::class)->prefix('/page')->name('pages.')->group(function () {
        Route::post('/{slug}', 'update')->name('update');
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

            Route::controller(PageController::class)->prefix('/{slugChapter}')->name('page.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/create', 'store')->name('store');
                Route::get('/{slugPage}', 'show')->name('show');
                Route::get('/{slugPage}/edit', 'edit')->name('edit');
            });
        });
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/logs', [AdminlogController::class, 'index'])->name('logs.index');

        Route::controller(AdminBookController::class)->prefix('/books')->name('book.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{slug}/edit', 'edit')->name('edit');
            Route::post('/{slug}/edit', 'update')->name('update');
        });

        Route::controller(AdminChapterController::class)->prefix('/chapters')->name('chapters.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{slug}/edit', 'edit')->name('edit');
            Route::post('/{slug}/edit', 'update')->name('update');
        });

        Route::controller(AdminPageController::class)->prefix('/pages')->name('pages.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{slug}/edit', 'edit')->name('edit');
            Route::post('/{slug}/edit', 'update')->name('update');
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

            Route::controller(ApiPageController::class)->prefix('/pages/{slugChapter}')->group(function () {
                Route::get('/{q?}', 'index');
                Route::post('/like/{page}', 'like');
                Route::delete('/delete/{page}', 'delete');
            });
        });
    });

    Route::prefix('/admin')->group(function () {
        Route::get('/logs', [ApiAdminLogController::class, 'index']);

        Route::controller(ApiAdminBookController::class)->prefix('/books')->group(function () {
            Route::get('/{q?}', 'index');
        });

        Route::controller(ApiAdminChapterController::class)->prefix('/chapters')->group(function () {
            Route::get('/{q?}', 'index');
        });

        Route::get('/pages/{q?}', [ApiAdminPageController::class, 'index']);
    });

    Route::get('/trans', ApiTransController::class);
});
