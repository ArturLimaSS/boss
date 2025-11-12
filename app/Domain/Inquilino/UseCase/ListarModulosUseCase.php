<?php 

namespace App\Domain\Inquilino\UseCase;

use App\Models\ModulosModel;

class ListarModulosUseCase implements ListarModulosUseCaseInterface
{
  public function __construct(
    protected ModulosModel $model
  ){}
  
  public function execute(array $dados){
    $lista_modulos = $this->model->leftJoin("tb_inquilino_modulos", "tb_modulos.id", "=", "tb_inquilino_modulos.modulo_id")->where("tb_inquilino_modulos.inquilino_id", "=", inquilino()->id)->get();
    return ["lista_modulos" => $lista_modulos];
  }
}