<?php

namespace App\Http\Middleware;

use App\Models\InquilinoUsuarioModel;
use App\Models\UsuarioModulosModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class InquilinoMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user) {
            $cache_key                        = 'inquilino_usuario_' . $user->id;
            $tempo_para_buscar_dados_em_banco = 30;

            cache()->remember($cache_key, now()->addMinutes($tempo_para_buscar_dados_em_banco), function () use ($user) {
                $inquilinoUsuario = InquilinoUsuarioModel::with("inquilino")
                    ->with("usuarioTipo")
                    ->where('usuario_id', $user->id)
                    ->first();
                $usuarioModulos = UsuarioModulosModel::with("modulo")->where("usuario_id", "=", $user->id)
                    ->where("inquilino_id", "=", $inquilinoUsuario->inquilino_id)
                    ->where("ativo", "=", true)
                    ->get();

                return [
                    'inquilino'         => $inquilinoUsuario->inquilino,
                    'inquilino_usuario' => $inquilinoUsuario,
                    'usuario_modulos'   => $usuarioModulos->toArray(),
                ];
            });
        }

        return $next($request);
    }
}
