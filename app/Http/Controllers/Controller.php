<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Throwable;

abstract class Controller
{
    public function useCase(
        string $interfaceName,
        array $dados = [],
        string $error_message = 'Ocorreu um erro ao tentar executar esta ação.',
        string $success_message = 'Ação executada com sucesso!'
    ): JsonResponse {
        if (! interface_exists($interfaceName)) {
            throw new Exception("A interface {$interfaceName} nao existe", 500);
        }

        $objeto = App::make($interfaceName);

        if (! method_exists($objeto, 'execute')) {
            throw new Exception("O seu caso de uso (use case) carece do método 'execute'. Classe: ".get_class($objeto));
        }
        DB::beginTransaction();

        try {
            $resultado = call_user_func_array([$objeto, 'execute'], [$dados]);
            DB::commit();

            return response()->json(
                [
                    'message' => $success_message,
                    'data' => $resultado,
                ],
                200
            );
        } catch (Throwable $th) {
            $obj = [
                'message' => $error_message,
                'error' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'code' => $th->getCode(),
                'trace' => $th->getTrace(),
            ];

            DB::rollBack();

            return response()->json(
                $obj,
                500
            );
        }
    }
}
