<?php

namespace App\Domain\Auth\UseCase;

use App\Models\User;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Laravel\Sanctum\PersonalAccessToken;

class SSOCheckUseCase implements SSOCheckUseCaseInterface
{
    public function execute(array $dados)
    {
        $jwt = $dados["token"];

        try {
            $jwt = JWT::decode($jwt, new Key(env("JWT_SECRET"), "HS256"));
        } catch (\Throwable $e) {
            throw new Exception("Token invalido " . $e->getMessage());
        }

        $user = User::find($jwt->sub);

        $token = PersonalAccessToken::where('tokenable_id', $user->id)
            ->where('tokenable_type', User::class)
            ->first();

        if (! $token) {
            throw new Exception("Sessao invalida", 401);
        }

        return true;
    }
}
