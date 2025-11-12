<?php

namespace App\Domain\Usuario\Repository;

use App\Domain\Usuario\Entity\Usuario;
use App\Models\InquilinoUsuarioModel;
use App\Models\User;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UsuarioRepository implements UsuarioRepositoryInterface
{
    // Implementação do repositório de Usuario
    public function __construct(protected User $model)
    {
    }

    public function listar($dados): array | Collection | LengthAwarePaginator
    {
        $query = $this->model
            ->leftJoin(
                "tb_inquilino_usuario",
                "users.id",
                "=",
                "tb_inquilino_usuario.usuario_id"
            )
            ->where("tb_inquilino_usuario.inquilino_id", inquilino()->id)
            ->where("users.id", "!=", 1)
            ->where("tb_inquilino_usuario.ativo", "=", "1")
            ->select([
                'users.id as id',
                'users.name',
                'users.email',
                'users.email_verified_at',
                'users.created_at',
                'users.updated_at',
                'tb_inquilino_usuario.inquilino_id',
                'tb_inquilino_usuario.usuario_id',
                'tb_inquilino_usuario.usuario_tipo_id',
                'tb_inquilino_usuario.ativo',
            ])
            ->orderBy("users.name");

        return $query->get();
    }

    public function cadastrar(Usuario $dados): User
    {
        $arry = array_merge(
            $dados->toArray(),
            [
                "password" => $dados->password()->toHash(),
            ]
        );
        $usuario = $this->model->create($arry);

        return $usuario;
    }

    public function atualizar(array $dados): User
    {
        $usuario = $this->findById($dados["id"]);

        if (! empty($dados['password'])) {
            $dados['password'] = Hash::make($dados['password']);
        } else {
            unset($dados['password']);
        }

        $usuario->fill($dados);
        $usuario->save();

        return $usuario;
    }

    public function excluir($id): void
    {
        $usuario        = InquilinoUsuarioModel::where("usuario_id", "=", $id)->where("inquilino_id", "=", inquilino()->id)->first();
        $usuario->ativo = false;
        $usuario->save();
    }

    public function findById($id): User
    {
        $usuario = $this->model->find($id);

        if (! isset($usuario)) {
            throw new Exception("Usuario nao encontrado!");
        }

        return $usuario;
    }
}
