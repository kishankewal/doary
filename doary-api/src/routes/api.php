<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Welcome, valid ad!";
})->middleware('check.adid');