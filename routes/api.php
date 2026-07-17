<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login-user', [AuthController::class, 'userLogin']);
Route::post('/logout-user', [AuthController::class, 'userLogOut'])->middleware('auth:sanctum');
Route::post('/create-role', [RoleController::class, 'registerUserRole'])->middleware('auth:sanctum');

Route::get('/all-users', [UserController::class, 'allUser'])->middleware('auth:sanctum');
Route::get('/single-users/{id}', [UserController::class, 'singleUser'])->middleware('auth:sanctum');
Route::post('/register-user', [UserController::class, 'registerUser'])->middleware('auth:sanctum');
Route::post('/update-user/{id}', [UserController::class, 'updateUser'])->middleware('auth:sanctum');
Route::delete('/delete-user/{id}', [UserController::class, 'userDelete'])->middleware('auth:sanctum');

Route::post('/add-company', [CompanyController::class, 'addCompany'])->middleware('auth:sanctum');
Route::get('/companyes', [CompanyController::class, 'allCompanyShow'])->middleware('auth:sanctum');
Route::get('/company/{id}', [CompanyController::class, 'singleCompanyShow'])->middleware('auth:sanctum');
Route::post('/company/update/{id}', [CompanyController::class, 'companyUpdate'])->middleware('auth:sanctum');
Route::delete('/company/delete/{id}', [CompanyController::class, 'deleteCompany'])->middleware('auth:sanctum');
Route::post('/add-company/contact', [CompanyController::class, 'addCompanyContact'])->middleware('auth:sanctum');
Route::get('/company/all/contacts', [CompanyController::class, 'showAllCompanyContact'])->middleware('auth:sanctum');
Route::get('/company/single/contacts/{id}', [CompanyController::class, 'showSingleCompanyContact'])->middleware('auth:sanctum');



