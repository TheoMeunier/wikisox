<?php

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



Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::controller(BookController::class)->prefix('/books')->name('book.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{book}', 'edit')->name('edit');
        Route::post('/edit/{book}', 'update')->name('update');

        Route::controller(ChapterController::class)->prefix('/{book}')->name('chapter.')->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });
});



require __DIR__.'/auth.php';
