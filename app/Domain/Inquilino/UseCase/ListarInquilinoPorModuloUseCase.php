<?php

namespace App\Domain\Inquilino\UseCase;

use App\Models\InquilinoModel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ListarInquilinoPorModuloUseCase implements ListarInquilinoPorModuloUseCaseInterface
{
    public function __construct(protected InquilinoModel $model)
    {
    }

    public function execute(array $dados): array | LengthAwarePaginator | Collection
    {
        $lista = DB::table("tb_inquilino_modulos")->where("modulo_id", $dados["modulo_id"])
            ->join("tb_inquilino", "tb_inquilino.id", "=", "tb_inquilino_modulos.inquilino_id")
            ->select("tb_inquilino.*")
            ->get();

        return $lista;
    }
}
