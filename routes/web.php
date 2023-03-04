<?php

use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminChapterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminlogController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminUserController;
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
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
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
        Route::post('/{slug}/edit', 'update')->name('update')->middleware('can:chapter edit');
        Route::delete('/{slug}/delete', 'delete')->name('delete')->middleware('can:chapter delete');
    });

    Route::controller(PageController::class)->prefix('/page')->name('pages.')->group(function () {
        Route::post('/{slug}', 'update')->name('update')->middleware('can:page edit');
        Route::delete('/{slug}/delete', 'delete')->name('delete')->middleware('can:page delete');
    });

    Route::controller(ProfileController::class)->prefix('/profile')->name('profile.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit', 'edit')->name('edit');
    });

    Route::controller(BookController::class)->prefix('/books')->name('book.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create')->middleware('can:book create');
        Route::post('/create', 'store')->name('store')->middleware('can:book create');
        Route::get('/{slug}/edit', 'edit')->name('edit')->middleware('can:book edit');
        Route::post('/{slug}/edit', 'update')->name('update')->middleware('can:book edit');
        Route::delete('/{slug}/delete', 'delete')->name('delete')->middleware('can:book delete');

        Route::controller(ChapterController::class)->prefix('/{slug}')->name('chapter.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create')->middleware('can:chapter create');
            Route::post('/create', 'store')->name('store')->middleware('can:chapter create');
            Route::get('/{slugChapter}/edit', 'edit')->name('edit')->middleware('can:chapter edit');

            Route::controller(PageController::class)->prefix('/{slugChapter}')->name('page.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create')->middleware('can:page create');
                Route::post('/create', 'store')->name('store')->middleware('can:page create');
                Route::get('/{slugPage}', 'show')->name('show');
                Route::get('/{slugPage}/edit', 'edit')->name('edit')->middleware('can:page edit');
            });
        });
    });

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
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

        Route::controller(AdminUserController::class)->prefix('/users')->name('users.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
        });

        Route::controller(AdminRoleController::class)->prefix('/roles')->name('roles.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
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

    Route::controller(ApiChapterController::class)->prefix('/chapters')->group(function () {
        Route::post('/like/{chapter}', 'like');
    });

    Route::controller(ApiProfileController::class)->prefix('/profile')->group(function () {
        Route::put('/update', 'update');
        Route::put('/update/password', 'updatePassword');
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

        Route::get('/users/{q?}', [ApiAdminUserController::class, 'index']);
    });

    Route::get('/auth', [ApiAuthController::class, 'index']);
});
