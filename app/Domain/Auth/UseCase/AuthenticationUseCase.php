<?php

namespace App\Domain\Auth\UseCase;

use App\Models\User;

class AuthenticationUseCase implements AuthenticationUseCaseInterface
{
    public function execute(array $dados): array
    {

        $user = User::where("email", "=", $dados["email"]);
        return $dados;
    }
}
