<?php

namespace App\Domain\Usuario\UseCase;

use App\Domain\Usuario\Repository\UsuarioRepository;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ListarUsuarioUseCase implements ListarUsuarioUseCaseInterface
{
    public function __construct(protected UsuarioRepository $usuarioRepository)
    {
    }

    public function execute(array $dados): array | LengthAwarePaginator | Collection
    {
        // Implementar Método de listagem de ListarUsuarioUseCase
        return [
            "lista_usuario" => $this->usuarioRepository->listar($dados),
        ];
    }
}
