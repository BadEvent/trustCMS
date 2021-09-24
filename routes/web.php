<?php

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

Route::group(['middleware' => ['checkAuth']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');
    });

    Route::prefix('pages')->group(function () {
        Route::get('/all', [\App\Http\Controllers\Pages\PagesController::class, 'pagesAll'])->name('pagesAll');
        Route::get('/create', [\App\Http\Controllers\Pages\PagesController::class, 'pagesCreate'])->name('pagesCreate');
        Route::post('/create/post', [\App\Http\Controllers\Pages\PagesController::class, 'pagesCreatePost'])->name('pagesCreatePost');
        Route::post('/edit/post/{id}', [\App\Http\Controllers\Pages\PagesController::class, 'pagesEditPost'])->name('pagesEditPost');
        Route::get('/edit/{id}', [\App\Http\Controllers\Pages\PagesController::class, 'pagesEdit'])->name('pagesEdit');
        Route::get('/{link}', [\App\Http\Controllers\Pages\PagesController::class, 'pagesId'])->name('pagesId');

    });
});

//mainPages
Route::get('/', [\App\Http\Controllers\MainPagesController::class, 'index'])->name('index');



//Auth
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'loginPost'])->name('loginPost');
Route::post('/register', [\App\Http\Controllers\Auth\LoginController::class, 'registerPost'])->name('registerPost');
Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
