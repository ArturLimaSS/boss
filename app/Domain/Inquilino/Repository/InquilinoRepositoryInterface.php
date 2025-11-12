<?php

namespace App\Domain\Inquilino\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface InquilinoRepositoryInterface
{
    // Métodos esperados para o repositório de Inquilino

    public function listar($dados): array|Collection|LengthAwarePaginator;

    public function cadastrar();

    public function atualizar();

    public function excluir(): void;

    public function findById();
}