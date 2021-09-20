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

Route::get('/', [\App\Http\Controllers\MainPageController::class, 'index'])->name('index')->middleware(['checkAuth']);

//auth
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'loginPost'])->name('loginPost');
Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'registerPost']);
Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::post('/register/get/address', [\App\Http\Controllers\Auth\RegisterController::class, 'getAddress'])->name('getAddress');
Route::post('/register/get/housing', [\App\Http\Controllers\Auth\RegisterController::class, 'getHousing'])->name('getHousing');
Route::post('/register/get/office', [\App\Http\Controllers\Auth\RegisterController::class, 'getOffice'])->name('getOffice');


//tasks
Route::group(['middleware' => ['checkAuth']], function () {
    Route::prefix('task')->group(function () {
        Route::get('/', [\App\Http\Controllers\TaskController::class, 'taskDo'])->name('taskDo');
        Route::get('/all', [\App\Http\Controllers\TaskController::class, 'taskAll'])->name('taskAll');
        Route::get('/help', [\App\Http\Controllers\TaskController::class, 'taskDo'])->name('taskHelp');
        Route::get('/watch', [\App\Http\Controllers\TaskController::class, 'taskDo'])->name('taskWatch');
        Route::get('/create', [\App\Http\Controllers\TaskController::class, 'taskCreate'])->name('taskCreate');
        Route::post('/create', [\App\Http\Controllers\TaskController::class, 'taskCreatePost'])->name('taskCreatePost');
        Route::post('/end/{id}', [\App\Http\Controllers\TaskController::class, 'taskEnd'])->name('taskEnd');
        Route::get('/{id}', [\App\Http\Controllers\TaskController::class, 'taskId'])->name('taskId');

    });
});
