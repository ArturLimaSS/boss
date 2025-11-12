<?php

namespace App\Domain\Usuario\UseCase;

use App\Models\UsuarioModulosModel;

class AtualizarModulosUsuarioUseCase implements AtualizarModulosUsuarioUseCaseInterface
{
    public function __construct(
        protected UsuarioModulosModel $model
    ) {
    }

    public function execute(array $dados)
    {
        // Busca o registro de permissão do módulo pra esse usuário e inquilino
        $moduloUsuario = $this->model
            ->where('inquilino_id', inquilino()->id)
            ->where('usuario_id', $dados['usuario_id'])
            ->where('modulo_id', $dados['modulo_id'])
            ->first();

        if (! $moduloUsuario) {
            // Se não existe, cria (caso você queira criar automaticamente)
            $moduloUsuario = $this->model->create([
                'inquilino_id' => inquilino()->id,
                'usuario_id'   => $dados['usuario_id'],
                'modulo_id'    => $dados['modulo_id'],
            ]);
        } else {
            // Se existe, só atualiza
            $moduloUsuario->ativo = (bool) $dados['value'];
            $moduloUsuario->save();
        }

        $cache_key = "inquilino_usuario_" . $dados["usuario_id"];
        cache()->forget($cache_key);

        return $moduloUsuario;
    }
}
