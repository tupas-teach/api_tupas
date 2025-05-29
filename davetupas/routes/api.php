<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PaymentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
    Route::post('/register', [AuthenticationController::class, 'register']);
    Route::post('/login', [AuthenticationController::class, 'login']);

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

    Route::get('/get-users', [UserController::class, 'getUsers']);
    Route::post('/add-user', [UserController::class, 'addUser']);
    Route::put('/edit-user/{id}', [UserController::class, 'editUser']);
    Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);



Route::get('/clients', [ClientController::class, 'getClients']);
Route::post('/clients', [ClientController::class, 'addClient']);
Route::put('/clients/{id}', [ClientController::class, 'editClient']);
Route::delete('/clients/{id}', [ClientController::class, 'deleteClient']);


Route::get('/projects', [ProjectController::class, 'getProjects']);
Route::post('/projects', [ProjectController::class, 'addProject']);
Route::put('/projects/{id}', [ProjectController::class, 'editProject']);
Route::delete('/projects/{id}', [ProjectController::class, 'deleteProject']);


Route::get('/materials', [MaterialController::class, 'getMaterials']);
Route::post('/materials', [MaterialController::class, 'addMaterial']);
Route::put('/materials/{id}', [MaterialController::class, 'editMaterial']);
Route::delete('/materials/{id}', [MaterialController::class, 'deleteMaterial']);


Route::get('/payments', [PaymentController::class, 'getPayments']);
Route::post('/payments', [PaymentController::class, 'addPayment']);
Route::put('/payments/{id}', [PaymentController::class, 'editPayment']);
Route::delete('/payments/{id}', [PaymentController::class, 'deletePayment']);

   Route::post('/logout', [AuthenticationController::class, 'logout']);
});
