<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', function () {
    Auth::logout();
    return Redirect('/');
});

Auth::routes();
Route::middleware(['checkLevel:ADMIN'])->group(function () {
    Route::prefix('major')->group(function () {
        Route::get('/', [App\Http\Controllers\MajorController::class, 'index']);
        Route::get('/getData', [App\Http\Controllers\MajorController::class, 'getData']);
        Route::post('/createData', [App\Http\Controllers\MajorController::class, 'create']);
        Route::post('/updateData/{id}', [App\Http\Controllers\MajorController::class, 'update']);
        Route::post('/deleteData/{id}', [App\Http\Controllers\MajorController::class, 'delete']);
        // Route::post('/createData', [App\http\Controllers\NewsController::class, 'Create']);

    });
});
Route::middleware(['checkLevel:USER'])->group(function () {
    Route::prefix('student')->group(function () {
        Route::get('/', [App\Http\Controllers\StudentsController::class, 'index']);
        Route::post('/createData', [App\Http\Controllers\StudentsController::class, 'create']);
        Route::get('/getData', [App\Http\Controllers\StudentsController::class, 'getData']);
        Route::post('/updateData/{id}', [App\Http\Controllers\StudentsController::class, 'update']);
        Route::post('/deleteData/{id}', [App\Http\Controllers\StudentsController::class, 'delete']);
    });
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [App\Http\Controllers\UserController::class, 'index']);
Route::post('/authLogin', [App\Http\Controllers\UserController::class, 'login']);

Route::prefix('user')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

});
Route::prefix('trash')->group(function () {
    Route::get('/student', [App\Http\Controllers\StudentsController::class, 'indexRestore']);
    Route::get('/student/getDataRestore', [App\Http\Controllers\StudentsController::class, 'getDataRestore']);
    Route::post('/student/restoreData/{id}', [App\http\Controllers\StudentsController::class,'restoreData']);
    Route::post('/student/forch/{id}', [App\http\Controllers\StudentsController::class, 'deletePermanentData']);
});
