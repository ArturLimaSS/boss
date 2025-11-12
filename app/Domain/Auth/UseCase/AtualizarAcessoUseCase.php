<?php 

namespace App\Domain\Auth\UseCase;

use App\Domain\Usuario\Repository\UsuarioRepository;

class AtualizarAcessoUseCase implements AtualizarAcessoUseCaseInterface 
{
  public function __construct(
    protected UsuarioRepository $usuarioRepository
  ){}
  public function execute(array $dados){
  $usuario =  $this->usuarioRepository->atualizar($dados);
    $cache_key = "inquilino_usuario_". $usuario->id;
    cache()->forget($cache_key);

    return $usuario;
  }
}