<?php

namespace App\Domain\Usuario\UseCase;

use App\Models\UsuarioModulosModel;

class ListarModulosUsuarioUseCase implements ListarModulosUsuarioUseCaseInterface
{
    public function __construct(
        protected UsuarioModulosModel $model
    ) {
    }

    public function execute(array $dados)
    {
        $lista_modulos_usuario = $this->model->where("inquilino_id", "=", inquilino()->id)
            ->where("usuario_id", "=", $dados["id"])->get();

        return ["lista_modulos_usuario" => $lista_modulos_usuario];
    }
}
