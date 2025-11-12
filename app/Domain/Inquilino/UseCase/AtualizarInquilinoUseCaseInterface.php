<?php

namespace App\Domain\Inquilino\UseCase;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface AtualizarInquilinoUseCaseInterface
{
    public function execute(array $dados);
}