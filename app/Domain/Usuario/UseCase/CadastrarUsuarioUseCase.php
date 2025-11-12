<?php

namespace App\Domain\Usuario\UseCase;

use App\Domain\Usuario\Entity\Usuario;
use App\Domain\Usuario\Repository\UsuarioRepository;
use App\Mail\EnviaCredenciaisDeAcessoMailer;
use App\Models\InquilinoUsuarioModel;
use Illuminate\Support\Facades\Mail;

class CadastrarUsuarioUseCase implements CadastrarUsuarioUseCaseInterface
{
    public function __construct(protected UsuarioRepository $usuarioRepository)
    {
    }

    public function execute(array $dados)
    {
        $usuario = new Usuario($dados);

        $usuario_cadastrado = $this->usuarioRepository->cadastrar( $usuario);

        InquilinoUsuarioModel::create([
            "usuario_id"      => $usuario_cadastrado->id,
            "inquilino_id"    => inquilino()->id,
            "usuario_tipo_id" => $dados["usuario_tipo_id"],
        ]);

        $obj_usuario = array_merge(
            $usuario->toArray(),
            ["password" => $usuario->password()->value()]
        );

        Mail::to($usuario_cadastrado->email)->send(new EnviaCredenciaisDeAcessoMailer([
            "usuario" => $obj_usuario,
        ]));

        

        return ["usuario" => $usuario];
    }
}
