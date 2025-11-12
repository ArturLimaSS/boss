<?php

namespace App\Models;

class InquilinoUsuarioModel extends BaseModel
{
    /**
    * Indica se a chave primária do modelo não é um inteiro auto-incrementável.
    * Deve ser definido como false para UUIDs.
    * @var bool
    */
    public $incrementing = false;

    /**
     * O tipo de dado da chave primária.
     * Deve ser definido como 'string' para UUIDs.
     * @var string
     */
    protected $keyType = 'string';

    protected $table = 'tb_inquilino_usuario';

    protected $fillable = [
        "inquilino_id",
        "usuario_id",
        "usuario_tipo_id",
        "ativo",
    ];

    public function inquilino()
    {
        return $this->hasOne(InquilinoModel::class, "id", "inquilino_id");
    }

    public function usuarioTipo()
    {
        return $this->hasOne(UsuarioTipoModel::class, "id", 'usuario_tipo_id');
    }
}
