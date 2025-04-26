<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DnsController;
use App\Http\Controllers\NasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DdnsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoggingController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfNotAuthenticated;

//DASHBOARD
Route::get('/main' , [MainController::class , 'index'])->middleware(RedirectIfNotAuthenticated::class)->name('main.index');


// ADMINISTRATOR 
Route::get('/user', [UserController::class , 'index'])->middleware(RedirectIfNotAuthenticated::class)->name('user.index');
//->middleware(RedirectIfNotAuthenticated::class);
Route::post('/user' , [UserController::class , 'add'])->middleware(RedirectIfNotAuthenticated::class)->name('user.post');
Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->middleware(RedirectIfNotAuthenticated::class)->name('user.delete');
Route::post('/user/reset-password/{id}',[UserController::class, 'reset_password'])->middleware(RedirectIfNotAuthenticated::class)->name('password.reset');
Route::post('/user/update/',[UserController::class, 'update'])->middleware(RedirectIfNotAuthenticated::class)->name('user.update');

// AUTH
// Route::get('/auth' , [AuthController::class , 'index'])->middleware(RedirectIfAuthenticated::class);
// Route::post('/auth' , [AuthController::class , 'authenticate'])->middleware(RedirectIfAuthenticated::class);
Route::get('/profile' , [AuthController::class , 'profile'])->middleware(RedirectIfNotAuthenticated::class);
Route::get('/change-password' , [AuthController::class , 'change_password'])->middleware(RedirectIfNotAuthenticated::class);
// Route::post('/logout' , [AuthController::class , 'logout']);

// GROUP
Route::get('/group', [GroupController::class , 'index'])->middleware(RedirectIfNotAuthenticated::class)->name('group.index');
Route::post('/group' , [GroupController::class , 'add'])->middleware(RedirectIfNotAuthenticated::class)->name('group.post');
Route::delete('/group/delete/{id}' , [GroupController::class , 'delete'])->middleware(RedirectIfNotAuthenticated::class)->name('group.delete');

// PRIVILEGE
Route::get('/privilege', [PrivilegeController::class , 'index'])->middleware(RedirectIfNotAuthenticated::class)->name('privilege.index');
Route::post('/privilege' , [PrivilegeController::class , 'add'])->middleware(RedirectIfNotAuthenticated::class)->name('privilege.post');
Route::delete('/privilege/delete/{id}' , [PrivilegeController::class , 'delete'])->middleware(RedirectIfNotAuthenticated::class)->name('privilege.delete');
Route::get('/privilege/combo-privilege/{id}', [PrivilegeController::class, 'comboPrivilege'])->middleware(RedirectIfNotAuthenticated::class);
Route::get('/privilege/view-permission-privilege/{id}', [PrivilegeController::class, 'viewPermissionPrivilege'])->middleware(RedirectIfNotAuthenticated::class)->name('PermissionPrivilege.view');
Route::post('/privilege/update/',[PrivilegeController::class, 'update'])->middleware(RedirectIfNotAuthenticated::class)->name('privilege.update');

//LOG
Route::get('/log', [LoggingController::class , 'index'])->middleware(RedirectIfNotAuthenticated::class)->name('log.index');
//NAS
Route::get('/nas/attributes', [NasController::class , 'attributes'])->middleware(RedirectIfNotAuthenticated::class)->name('nas.attributes');
Route::get('/nas/lists', [NasController::class , 'lists'])->middleware(RedirectIfNotAuthenticated::class)->name('nas.lists');
Route::get('/nas/users', [NasController::class , 'users'])->middleware(RedirectIfNotAuthenticated::class)->name('nas.users');
Route::get('/nas/profile-bandwidth', [NasController::class , 'profile_bandwidth'])->middleware(RedirectIfNotAuthenticated::class)->name('nas.bw');
Route::get('/nas/profile-ppp', [NasController::class , 'profile_ppp'])->middleware(RedirectIfNotAuthenticated::class)->name('nas.ppp');

//SERVICE DNS
Route::get('/services/dns-management', [DnsController::class , 'lists'])->middleware(RedirectIfNotAuthenticated::class)->name('dns.lists');

//SERVICE DDNS
Route::get('/services/ddns-lists', [DdnsController::class , 'lists'])->middleware(RedirectIfNotAuthenticated::class)->name('ddns.lists');
Route::get('/services/ddns-users', [DdnsController::class , 'users'])->middleware(RedirectIfNotAuthenticated::class)->name('ddns.users');
Route::get('/services/ddns-forwarding', [DdnsController::class , 'forwarding'])->middleware(RedirectIfNotAuthenticated::class)->name('ddns.forwarding');


// TESTING
// Route::get('/test', function(){
//     dd(auth()->user());
// });

//WEB KOSONG
// Route::fallback(function () {})->middleware([RedirectIfAuthenticated::class , RedirectIfNotAuthenticated::class]);

//TEST
//Route::get('/user/test/', [UserController::class , 'test']);