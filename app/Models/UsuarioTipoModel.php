<?php

namespace App\Models;

class UsuarioTipoModel extends BaseModel
{
    protected $table = "tb_usuario_tipo";

    protected $fillable = [
        "nome",
    ];
}
