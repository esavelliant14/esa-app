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

//DASHBOARD
Route::get('/main' , [MainController::class , 'index'])->middleware(RedirectIfNotAuthenticated::class);


// ADMINISTRATOR 
Route::get('/user', [UserController::class , 'index'])->middleware(RedirectIfNotAuthenticated::class);
Route::post('/user' , [UserController::class , 'add'])->middleware(RedirectIfNotAuthenticated::class);
Route::delete('/user/delete/{id}', [UserController::class, 'delete']);

// AUTH
Route::get('/auth' , [AuthController::class , 'index'])->middleware(RedirectIfAuthenticated::class);
Route::post('/auth' , [AuthController::class , 'authenticate'])->middleware(RedirectIfAuthenticated::class);
Route::get('/profile' , [AuthController::class , 'profile'])->middleware(RedirectIfNotAuthenticated::class);
Route::get('/change-password' , [AuthController::class , 'change_password'])->middleware(RedirectIfNotAuthenticated::class);
Route::post('/logout' , [AuthController::class , 'logout']);

// COMPANY
Route::get('/company', [CompanyController::class , 'index'])->middleware(RedirectIfNotAuthenticated::class);
Route::post('/company' , [CompanyController::class , 'add'])->middleware(RedirectIfNotAuthenticated::class);
//Route::post('/company' , [CompanyController::class , 'delete'])->middleware(RedirectIfNotAuthenticated::class);

// PRIVILEGE
Route::get('/privilege', [PrivilegeController::class , 'index'])->middleware(RedirectIfNotAuthenticated::class);
Route::post('/privilege' , [PrivilegeController::class , 'add'])->middleware(RedirectIfNotAuthenticated::class);
//Route::post('/privilege' , [PrivilegeController::class , 'delete'])->middleware(RedirectIfNotAuthenticated::class);
Route::get('/privilege/combo-privilege/{id}', [PrivilegeController::class, 'comboPrivilege'])->middleware(RedirectIfNotAuthenticated::class);


//NAS
Route::get('/nas/attribute', [NasController::class , 'attribute'])->middleware(RedirectIfNotAuthenticated::class);

//WEB KOSONG
//Route::fallback(function () {})->middleware([RedirectIfAuthenticated::class , RedirectIfNotAuthenticated::class]);