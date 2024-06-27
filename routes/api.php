<?php

use App\Http\Controllers\AuthenticateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthenticateUser::class, 'register'])->name('register');
Route::post('/login', [AuthenticateUser::class, 'login'])->name('login');

Route::group(["middleware" => "auth:sanctum"], function () {
    Route::get('/profileIdAuth', [AuthenticateUser::class, 'profileIdAuth'])->name('profileIdAuth');
    Route::get('/allProfile', [AuthenticateUser::class, 'allProfile'])->name('allProfile');
});