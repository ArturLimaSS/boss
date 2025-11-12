<?php

namespace App\Domain\Inquilino\Routes;

use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::group(['prefix' => 'inquilino'], function () {
            Route::get("/listar-modulos", [\App\Http\Controllers\InquilinoController::class, "listarModulosPorInquilino"]);
        });
    });

    Route::group(['prefix' => 'inquilino'], function () {
        Route::post('/cadastrar', [\App\Http\Controllers\InquilinoController::class, 'cadastrar']);
        Route::get("/inquilinos-com-este-modulo", [\App\Http\Controllers\InquilinoController::class, "listarInquilinosPorModulo"]);
    });
});
