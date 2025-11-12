<?php

namespace App\Domain\Usuario\UseCase;

use App\Domain\Usuario\Repository\UsuarioRepository;

class ExcluirUsuarioUseCase implements ExcluirUsuarioUseCaseInterface
{
    public function __construct(protected UsuarioRepository $usuarioRepository)
    {
    }

    public function execute(array $dados)
    {
        $this->usuarioRepository->excluir($dados["id"]);
    }
}
