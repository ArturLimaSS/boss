<?php

namespace App\Domain\Auth\Routes;

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function () {
    Route::post("auth/login", [AuthController::class, "login"]);
    Route::middleware(['auth:sanctum', "inquilino"])->group(function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post("check", [AuthController::class, "check"]);
            Route::put("atualizar-acesso", [AuthController::class, "atualizarAcesso"]);
            Route::post("logout", [AuthController::class, "logout"]);
            Route::post("acessar-modulo", [AuthController::class, "acessarModulo"]);
        });
    });

    Route::get("/sso/check", [AuthController::class, "SSOCheck"]);
});
