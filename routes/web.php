<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListUserController;
use App\Http\Controllers\ReceivingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

//list user
// routes/web.php
Route::get('/list_user', [ListUserController::class, 'listUser'])->name('list_user');
Route::get('/list_user/data', [ListUserController::class, 'getUserData'])->name('list_user.data');
Route::delete('delete_user/{id}', [ListUserController::class, 'delete'])->name('delete_user');
Route::get('edit_user/{id}', [ListUserController::class, 'edit'])->name('edit_user');
Route::post('update_user/{id}', [ListUserController::class, 'update'])->name('update_user');

Auth::routes();

//list receiving
Route::get('/list_rec', [ReceivingController::class, 'listRec'])->name('list_rec');
Route::get('/list_rec/data', [ReceivingController::class, 'getRecData'])->name('list_rec.data');
Route::get('/create_rec', [ReceivingController::class, 'create']);
Route::post('/insert_rec', [ReceivingController::class, 'insert']);
Route::delete('delete_rec/{id}', [ReceivingController::class, 'delete'])->name('delete_rec');
Route::get('edit_rec/{id}', [ReceivingController::class, 'edit'])->name('edit_rec');
Route::post('update_rec/{id}', [ReceivingController::class, 'update'])->name('update_rec');

//calculate amount
Route::get('/installment', function () {
    return view('installment');
});

Route::fallback(function () {
    return "<h1>Page not Found</h1>";
});
