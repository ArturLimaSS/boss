<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("v1/auth/login", [AuthController::class, "login"]);

require base_path('app/Domain/Inquilino/Routes/InquilinoRoutes.php');

require base_path('app/Domain/Auth/Routes/AuthRoutes.php');

require base_path('app/Domain/Usuario/Routes/UsuarioRoutes.php');
