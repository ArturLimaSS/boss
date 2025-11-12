<?php

namespace App\Domain\Inquilino\UseCase;

use App\Models\InquilinoModel;
use App\Models\InquilinoModulosModel;
use App\Models\InquilinoUsuarioModel;
use App\Models\ModulosModel;
use App\Models\UsuarioModulosModel;
use Exception;
use Illuminate\Support\Facades\Http; // Importação necessária

class CadastrarInquilinoUseCase implements CadastrarInquilinoUseCaseInterface
{
    public function __construct(
        protected InquilinoModel $model,
        protected InquilinoModulosModel $inquilinoModulosModel
    ) {
    }

    public function execute(array $dados)
    {
        $ultimo_inquilino = InquilinoModel::orderBy('id', 'desc')->first();
        $nextSequentialId = $ultimo_inquilino ? $ultimo_inquilino->id + 1 : 1;

        $inquilino = InquilinoModel::create(array_merge($dados, [
            'id' => $nextSequentialId, // Forçamos o ID
        ]));

        InquilinoUsuarioModel::create([
            "usuario_id"      => 1,
            "inquilino_id"    => $inquilino->id,
            "usuario_tipo_id" => "be506f43-742c-4b04-b288-6bd2e6ffd07e",
        ]);

        foreach ($dados["modulos"] as $modulo_id) {
            $modulo = ModulosModel::find($modulo_id);
            $this->inquilinoModulosModel->create([
                "inquilino_id" => $inquilino->id,
                "modulo_id"    => $modulo_id,
                // "url_api" 	=> $modulo->url_api,
            ]);

            UsuarioModulosModel::create([
                "modulo_id"    => $modulo_id,
                "usuario_id"   => 1,
                "inquilino_id" => $inquilino->id,
            ]);

            $response = Http::post(env(strtoupper($modulo->prefixo) . "_API_URL") . "/v1/inquilino/gerar-ambiente", [
                "inquilino_id" => $inquilino->id,
                "modulo_id"    => $modulo_id,
                "prefixo"      => $modulo->prefixo,
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new Exception("Erro ao gerar ambiente para o módulo: " . $modulo->prefixo . ". Status: " . $response->getStatusCode() . " - " . $response->body());
            }
        }

        return $inquilino;
    }
}
