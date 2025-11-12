<?php

namespace App\Domain\Usuario\UseCase;

use App\Models\UsuarioTipoModel;

class ListarUsuarioTipoUseCase implements ListarUsuarioTipoUseCaseInterface
{
    public function execute(array $dados)
    {
        $lista_usuario_tipo = UsuarioTipoModel::where("id", "!=", "be506f43-742c-4b04-b288-6bd2e6ffd07e")->get();

        return ["lista_usuario_tipo" => $lista_usuario_tipo];
    }
}
