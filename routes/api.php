<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login-user', [AuthController::class, 'userLogin']);
Route::post('/register-user', [AuthController::class, 'registerUser'])->middleware('auth:sanctum');
Route::post('/create-role', [RoleController::class, 'registerUserRole'])->middleware('auth:sanctum');
