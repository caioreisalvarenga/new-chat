<?php

use App\Http\Controllers\AuthenticateUser;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthenticateUser::class, 'register'])->name('register');
Route::get('/register', [AuthenticateUser::class, 'viewRegister'])->name('viewRegister');
Route::post('/login', [AuthenticateUser::class, 'login'])->name('login');
Route::get('/login', [AuthenticateUser::class, 'viewLogin'])->name('viewLogin');

Route::group(["middleware" => "auth:sanctum"], function () {
    Route::get('/profileIdAuth', [AuthenticateUser::class, 'profileIdAuth'])->name('profileIdAuth');
    Route::get('/allProfile', [AuthenticateUser::class, 'allProfile'])->name('allProfile');
    Route::get('/logout', [AuthenticateUser::class, 'logout'])->name('logout');
    Route::delete('/deleteProfile/{user}', [AuthenticateUser::class, 'deleteProfile'])->name('deleteProfile');
});
