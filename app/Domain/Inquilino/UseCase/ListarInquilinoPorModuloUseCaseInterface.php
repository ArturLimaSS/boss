<?php

namespace App\Domain\Inquilino\UseCase;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ListarInquilinoPorModuloUseCaseInterface
{
    public function execute(array $dados): array|LengthAwarePaginator|Collection;
}