<?php

namespace App\Domain\Usuario\UseCase;

use App\Models\ModulosModel;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Http;

class AcessarModuloUseCase implements AcessarModuloUseCaseInterface
{
    public function __construct(
        protected ModulosModel $modulosModel
    ) {
    }

    public function execute(array $dados)
    {
        $modulo_id = $dados["modulo_id"];

        $modulo = $this->modulosModel->find($modulo_id);

        $object = [
            "sub"          => auth()->user()->id,
            "email"        => auth()->user()->email,
            "name"         => auth()->user()->name,
            "modulo_id"    => $modulo_id,
            "inquilino_id" => inquilino()->id,
            "iat"          => time(),
            "exp"          => time() + 3600,
        ];

        $jwt = JWT::encode($object, env("JWT_SECRET"), 'HS256');

        $url     = $modulo->api_url . "/sso/receber-token";
        $payload = ['jwt' => $jwt];

        // $client = Http::asJson();

        $response = Http::post($url, $payload);

        $response_json = $response->json();

        if ($response->failed()) {
            throw new \Exception('Falha ao autenticar módulo.');
        }

        $jwtnonce = JWT::encode([
            "sub" => $response_json["data"],
            "@@"  => inquilino()->id,
            "iat" => time(),
            "exp" => time() + 3600,
        ], env("JWT_SECRET"), "HS256");

        return [
            'url' => $modulo->url . "/" . $jwtnonce,
        ];
    }
}
