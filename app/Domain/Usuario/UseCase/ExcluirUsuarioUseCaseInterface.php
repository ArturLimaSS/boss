<?php

namespace App\Domain\Usuario\UseCase;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ExcluirUsuarioUseCaseInterface
{
    public function execute(array $dados);
}