<?php

namespace App\Domain\Usuario\Repository;

use App\Domain\Usuario\Entity\Usuario;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UsuarioRepositoryInterface
{
    // Métodos esperados para o repositório de Usuario

    public function listar($dados): array | Collection | LengthAwarePaginator;

    public function cadastrar(Usuario $dados): User;

    public function atualizar(array $dados): User;

    public function excluir($id): void;

    public function findById($id): User;
}
