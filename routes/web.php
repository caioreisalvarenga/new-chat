<?php

use App\Http\Controllers\AuthenticateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

