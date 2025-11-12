<?php

namespace App\Domain\Inquilino\UseCase;

use App\Domain\Inquilino\UseCase\ListarInquilinoUseCaseInterface;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ListarInquilinoUseCase implements ListarInquilinoUseCaseInterface
{
    public function __construct(){}
    public function execute(array $dados):array|LengthAwarePaginator|Collection
    {
        // Implementar Método de listagem de ListarInquilinoUseCase
        return [];
    }
}