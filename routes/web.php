<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PrivilegeController;

Route::get('/main' , [MainController::class , 'index']);


// ADMINISTRATOR 
Route::get('/user', [UserController::class , 'index']);
Route::post('/user' , [UserController::class , 'add']);

// COMPANY
Route::get('/company', [CompanyController::class , 'index']);
Route::post('/company' , [CompanyController::class , 'add']);

// PRIVILEGE
Route::get('/privilege', [PrivilegeController::class , 'index']);
Route::post('/privilege' , [PrivilegeController::class , 'add']);


//NAS
Route::get('/nas/attribute', [NasController::class , 'attribute']);

//AUTH
Route::get('/auth' , [AuthController::class , 'index']);
