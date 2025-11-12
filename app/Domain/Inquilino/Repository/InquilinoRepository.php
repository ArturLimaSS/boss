<?php

namespace App\Domain\Inquilino\Repository;

use App\Domain\Inquilino\Repository\InquilinoRepositoryInterface;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class InquilinoRepository implements InquilinoRepositoryInterface
{
    // Implementação do repositório de Inquilino
    public function __construct(){}

    public function listar($dados): array|Collection|LengthAwarePaginator
    {
    }

    public function cadastrar()
    {
    }

    public function atualizar()
    {
    }

    public function excluir(): void 
    {
    }

    public function findById()
    {
    }
}