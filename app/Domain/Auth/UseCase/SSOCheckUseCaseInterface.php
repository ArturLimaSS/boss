<?php

namespace App\Domain\Auth\UseCase;

interface SSOCheckUseCaseInterface
{
    public function execute(array $dados);
}
