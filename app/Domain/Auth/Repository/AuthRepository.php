<?php

namespace App\Domain\Auth\Repository;

use App\Domain\Auth\Repository\AuthRepositoryInterface;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AuthRepository implements AuthRepositoryInterface
{
    // Implementação do repositório de Auth
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