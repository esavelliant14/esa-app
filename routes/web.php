<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfNotAuthenticated;

Route::get('/main' , [MainController::class , 'index'])->middleware(RedirectIfNotAuthenticated::class);


// ADMINISTRATOR 
Route::get('/user', [UserController::class , 'index'])->middleware(RedirectIfNotAuthenticated::class);
Route::post('/user' , [UserController::class , 'add']);

// AUTH
Route::get('/auth' , [AuthController::class , 'index'])->middleware(RedirectIfAuthenticated::class);
Route::post('/auth' , [AuthController::class , 'authenticate']);
Route::post('/logout' , [AuthController::class , 'logout']);

// COMPANY
Route::get('/company', [CompanyController::class , 'index'])->middleware(RedirectIfNotAuthenticated::class);
Route::post('/company' , [CompanyController::class , 'add']);

// PRIVILEGE
Route::get('/privilege', [PrivilegeController::class , 'index'])->middleware(RedirectIfNotAuthenticated::class);
Route::post('/privilege' , [PrivilegeController::class , 'add']);


//NAS
Route::get('/nas/attribute', [NasController::class , 'attribute'])->middleware(RedirectIfNotAuthenticated::class);