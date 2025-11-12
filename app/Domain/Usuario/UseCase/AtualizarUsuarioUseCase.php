<?php

namespace App\Domain\Usuario\UseCase;

use App\Domain\Usuario\Repository\UsuarioRepository;

class AtualizarUsuarioUseCase implements AtualizarUsuarioUseCaseInterface
{
    public function __construct(protected UsuarioRepository $usuarioRepository)
    {
    }

    public function execute(array $dados)
    {
       $usuario =  $this->usuarioRepository->atualizar($dados);
    
    }
}
