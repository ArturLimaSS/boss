<?php

use Illuminate\Support\Facades\Cache;

if (! function_exists("formatar_moeda")) {
    function formatar_moeda($valor)
    {
        $fmt = numfmt_create("pt_BR", NumberFormatter::CURRENCY);

        return numfmt_format_currency($fmt, $valor, "BRL");
    }
}

if (! function_exists("inquilino")) {
    function inquilino()
    {   
        $obj = Cache::get('inquilino_usuario_' . auth()->user()->id);

        return $obj["inquilino"];
    }
}

if (! function_exists("usuarioModulos")) {
    function usuarioModulos()
    {
        $obj = Cache::get('inquilino_usuario_' . auth()->user()->id);

        return $obj["usuario_modulos"];
    }
}

if (! function_exists("inquilinoUsuario")) {
    function inquilinoUsuario()
    {
        $obj = Cache::get('inquilino_usuario_' . auth()->user()->id);

        return $obj["inquilino_usuario"];
    }
}
