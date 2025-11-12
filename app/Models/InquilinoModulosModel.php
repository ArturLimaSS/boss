<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquilinoModulosModel extends BaseModel
{
    protected $table = 'tb_inquilino_modulos';

    protected $fillable = [
        "inquilino_id",
        "modulo_id",
        "ativo",
    ];
}
