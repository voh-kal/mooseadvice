<?php

use App\Http\Controllers\AdminController;
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

    Route::match(["GET"], '/home', [AdminController::class, "home"]);
    Route::match(["GET"], '/', [AdminController::class, "home"]);
    Route::match(["GET"], '/delete/{id}', [AdminController::class, "delete"]);
    Route::match(["GET", "POST"], '/edit/content/{id}', [AdminController::class, "edit"]);
