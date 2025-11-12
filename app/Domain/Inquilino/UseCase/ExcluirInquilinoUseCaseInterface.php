<?php

namespace App\Domain\Inquilino\UseCase;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ExcluirInquilinoUseCaseInterface
{
    public function execute(array $dados);
}