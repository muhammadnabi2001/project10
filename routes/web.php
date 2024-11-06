<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TalabaController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Check;
use Illuminate\Support\Facades\Route;

Route::get('index', function () {
    return view('index');
});
Route::get('/', function () {
    return view('index');
});
Route::get('/login',[LoginController::class,'loginpage']);
Route::get('/register',[LoginController::class,'registerpage']);
Route::post('/login',[LoginController::class,'login']);
Route::post('/register',[LoginController::class,'register']);
Route::get('/admin',[LoginController::class,'admin']);
Route::get('/logout',[LoginController::class,'logout']);

Route::post('createpost',[PostController::class,'create'])->middleware(Check::class.':admin,create');
Route::post('updatepost{id}',[PostController::class,'update'])->name('updatepost')->middleware(Check::class.':admin,update');
Route::get('/deletepost/{id}',[PostController::class,'delete'])->middleware(Check::class.':admin,delete');

Route::get('/users',[UserController::class,'users']);
Route::post('/createuser',[UserController::class,'create'])->middleware(Check::class.':admin,create');
Route::post('/updateuser/{id}',[UserController::class,'update'])->middleware(Check::class.':adim,update');
Route::get('/deleteuser/{id}',[UserController::class,'delete'])->middleware(Check::class.':adim,delete');

Route::get('talaba',[TalabaController::class,'talaba']);
Route::post('createtalaba',[TalabaController::class,'create']);
Route::post('updatetalaba',[TalabaController::class,'update']);
