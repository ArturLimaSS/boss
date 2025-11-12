<?php 

namespace App\Domain\Auth\UseCase;

interface AtualizarAcessoUseCaseInterface 
{
  public function execute(array $dados);
}