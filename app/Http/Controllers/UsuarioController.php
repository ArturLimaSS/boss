<?php

namespace App\Http\Controllers;

use App\Domain\Usuario\UseCase\AtualizarModulosUsuarioUseCaseInterface;
use App\Domain\Usuario\UseCase\AtualizarUsuarioUseCaseInterface;
use App\Domain\Usuario\UseCase\CadastrarUsuarioUseCaseInterface;
use App\Domain\Usuario\UseCase\ExcluirUsuarioUseCaseInterface;
use App\Domain\Usuario\UseCase\ListarModulosUsuarioUseCaseInterface;
use App\Domain\Usuario\UseCase\ListarUsuarioTipoUseCaseInterface;
use App\Domain\Usuario\UseCase\ListarUsuarioUseCaseInterface;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function cadastrar(Request $request)
    {
        return $this->useCase(CadastrarUsuarioUseCaseInterface::class, $request->all());
    }

    public function listar(Request $request)
    {
        // Lógica para cadastrar um usuário
        return $this->useCase(ListarUsuarioUseCaseInterface::class, $request->all());
    }

    public function atualizar(Request $request)
    {
        // Lógica para cadastrar um usuário
        return $this->useCase(AtualizarUsuarioUseCaseInterface::class, $request->all());
    }

    public function excluir(Request $request)
    {
        return $this->useCase(ExcluirUsuarioUseCaseInterface::class, $request->all());
    }

    public function listarUsuarioTipo(Request $request)
    {
        return $this->useCase(ListarUsuarioTipoUseCaseInterface::class, $request->all());
    }

    public function listarModulosUsuario(Request $request)
    {
        return $this->useCase(ListarModulosUsuarioUseCaseInterface::class, $request->all());
    }

    public function atualizarModulosUsuario(Request $request)
    {
        return $this->useCase(AtualizarModulosUsuarioUseCaseInterface::class, $request->all());
    }
}
