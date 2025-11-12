<?php

namespace App\Domain\Auth\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface AuthRepositoryInterface
{
    // Métodos esperados para o repositório de Auth

    public function listar($dados): array|Collection|LengthAwarePaginator;

    public function cadastrar();

    public function atualizar();

    public function excluir(): void;

    public function findById();
}