<?php

namespace App\Http\Controllers;

use App\Domain\Inquilino\UseCase\CadastrarInquilinoUseCaseInterface;
use App\Domain\Inquilino\UseCase\ListarInquilinoPorModuloUseCaseInterface;
use App\Domain\Inquilino\UseCase\ListarInquilinoUseCaseInterface;
use App\Domain\Inquilino\UseCase\ListarModulosUseCaseInterface;
use Illuminate\Http\Request;

class InquilinoController extends Controller
{
    public function cadastrar(Request $request)
    {
        return $this->useCase(CadastrarInquilinoUseCaseInterface::class, $request->all());
    }

    public function listar(Request $request)
    {
        return $this->useCase(ListarInquilinoUseCaseInterface::class, $request->all());
    }

    public function listarInquilinosPorModulo(Request $request)
    {
        return $this->useCase(ListarInquilinoPorModuloUseCaseInterface::class, $request->all());
    }

    public function listarModulosPorInquilino(Request $request){
        return $this->useCase(ListarModulosUseCaseInterface::class, $request->all());
    }
}
