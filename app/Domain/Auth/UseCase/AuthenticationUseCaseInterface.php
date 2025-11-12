<?php

namespace App\Domain\Auth\UseCase;

interface AuthenticationUseCaseInterface
{
    public function execute(array $dados): array;
}
