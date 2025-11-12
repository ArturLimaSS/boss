<?php

namespace App\Domain\Usuario\Routes;

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function () {
    Route::middleware(['auth:sanctum', "inquilino"])->group(function () {
        Route::group(['prefix' => 'usuario'], function () {
            Route::post("cadastrar", [UsuarioController::class, 'cadastrar']);
            Route::get("listar", [UsuarioController::class, 'listar']);
            Route::put("atualizar", [UsuarioController::class, 'atualizar']);
            Route::put("excluir", [UsuarioController::class, 'excluir']);
            Route::get("listar-usuario-tipo", [UsuarioController::class, 'listarUsuarioTipo']);

            Route::group(["prefix" => "modulos"], function(){
                Route::get("/listar", [UsuarioController::class, "listarModulosUSuario"]);
                Route::put("/atualizar", [UsuarioController::class, "atualizarModulosUsuario"]);
            });
        });
    });
});
