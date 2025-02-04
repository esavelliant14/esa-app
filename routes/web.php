<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;



Route::get('/main' , [MainController::class , 'index']);


// ADMINISTRATOR 
Route::get('/user/list/', [UserController::class , 'index']);
Route::get('/user', [UserController::class , 'index']);


//NAS
Route::get('/nas/attribute', [NasController::class , 'attribute']);

//AUTH
Route::get('/auth' , [AuthController::class , 'index']);