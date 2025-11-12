<?php

namespace App\Domain\Usuario\UseCase;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface AtualizarUsuarioUseCaseInterface
{
    public function execute(array $dados);
}