<?php

namespace App\Http\Controllers;

use App\Domain\Usuario\UseCase\AtualizarUsuarioUseCaseInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciais inválidas',
            ], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ]);
    }

    public function check()
    {
        try {
            $user             = auth()->user();
            $modulos          = usuarioModulos();
            $inquilino        = inquilino();
            $inquilinoUsuario = inquilinoUsuario();

            return response()->json(['user' => $user, "usuario_modulos" => $modulos,
                "inquilino"                 => $inquilino,
                "inquilinoUsuario"          => $inquilinoUsuario,

            ], 200);
        } catch (\Throwable $th) {
            $obj = [
                'error' => $th->getMessage(),
                'file'  => $th->getFile(),
                'line'  => $th->getLine(),
                'code'  => $th->getCode(),
                'trace' => $th->getTrace(),
            ];

            return response()->json(
                $obj,
                500
            );
        }
    }

    public function logout()
    {
        try {
            $user = auth()->user();

            if ($user) {
                $user
                    ->tokens() // Ignorar erro. Causa: Intelephense identifica erro onde não existe.
                    ->delete();

                return response()->json(['message' => 'Logout realizado com sucesso'], 200);
            } else {
                return response()->json(['error' => 'Usuário não autenticado'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function atualizarAcesso(Request $request){
        return $this->useCase(
            interfaceName: AtualizarUsuarioUseCaseInterface::class, 
            dados: $request->all(), 
            success_message: "Acesso atualizado com sucesso!", 
            error_message: "Ocorreu um erro ao tentar atualizar o acesso. Entre em contato com o suporte!"
        );
    }
}
