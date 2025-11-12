<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class InquilinoModel extends BaseModel
{
    use HasUuids;

    protected $table = 'tb_inquilino';

    protected $fillable = [
        "inquilino_numero",
        "nome",
        "cnpj",
        "telefone",
        "email",
        "cep",
        "rua",
        "numero",
        "bairro",
        "cidade",
        "uf",
        "pais",
        "ativo",
    ];

    public function inquilinoModulos()
    {
        return $this->hasMany(InquilinoModulosModel::class, 'inquilino_id', 'id');
    }
}
