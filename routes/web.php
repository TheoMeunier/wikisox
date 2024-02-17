<?php

use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminChapterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLogController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Api\ApiProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
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
    Route::controller(HomeController::class)->prefix('/')->name('home.')->group(function () {
        Route::get('/search', 'search')->name('search');
    });

    Route::get('/images/{path}', [ImageController::class, 'show'])->where('path', '.*')->name('images.show');

    Route::controller(ChapterController::class)->prefix('/chapter')->name('chapter.')->group(function () {
        Route::post('/{slug}/edit', 'update')->name('update')->middleware('can:chapter edit');
        Route::delete('/{slug}/delete', 'delete')->name('delete')->middleware('can:chapter delete');
    });

    Route::controller(PageController::class)->prefix('/page')->name('pages.')->group(function () {
        Route::post('/{slug}-{id}', 'update')
            ->name('update')
            ->middleware('can:page edit')
            ->where(['id' => '[0-9]+', 'slug' => '[a-z0-9\-]+']);
        Route::delete('/{slug}-{id}/delete', 'delete')
            ->name('delete')
            ->middleware('can:page delete')
            ->where(['id' => '[0-9]+', 'slug' => '[a-z0-9\-]+']);
        Route::get('/download/html/{slug}-{id}', 'downloadHtml')
            ->name('download.html')
            ->where(['id' => '[0-9]+', 'slug' => '[a-z0-9\-]+']);
        Route::get('/download/md/{slug}-{id}', 'downloadMarkdown')
            ->name('download.md')
            ->where(['id' => '[0-9]+', 'slug' => '[a-z0-9\-]+']);
        Route::get('/download/pdf/{slug}-{id}', 'downloadPdf')
            ->name('download.pdf')
            ->where(['id' => '[0-9]+', 'slug' => '[a-z0-9\-]+']);
    });

    Route::controller(ProfileController::class)->prefix('/profile')->name('profile.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit', 'edit')->name('edit');
        Route::get('/actions', 'actions')->name('actions');
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
                Route::get('/{slugPage}-{id}', 'show')
                    ->name('show')
                    ->where(['id' => '[0-9]+', 'slugPage' => '[a-z0-9\-]+']);
                Route::get('/{slugPage}-{id}/edit', 'edit')
                    ->name('edit')
                    ->where(['id' => '[0-9]+', 'slugPage' => '[a-z0-9\-]+'])
                    ->middleware('can:page edit');
            });
        });
    });

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::controller(AdminLogController::class)->prefix('/logs')->name('logs.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/export', 'export')->name('export');
        });

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
        return to_route('book.index');
    })->name('dashboard');

    //api
    Route::prefix('/webapi')->group(function () {
        Route::controller(ApiProfileController::class)->prefix('/profile')->group(function () {
            Route::post('/avatar', 'uploadAvatar');
        });
    });
});

Route::get('/pages/{token}', [PageController::class, 'showSharePage'])->name('pages.share');
