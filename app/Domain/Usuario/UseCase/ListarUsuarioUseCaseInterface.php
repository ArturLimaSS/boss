<?php

namespace App\Domain\Usuario\UseCase;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ListarUsuarioUseCaseInterface
{
    public function execute(array $dados): array|LengthAwarePaginator|Collection;
}