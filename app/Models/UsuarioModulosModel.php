<?php

namespace App\Models;

class UsuarioModulosModel extends BaseModel
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

    protected $table = 'tb_usuario_modulos';

    protected $fillable = [
        "usuario_id",
        "modulo_id",
        "inquilino_id",
        "ativo",
    ];

    public function modulo()
    {
        return $this->hasOne(ModulosModel::class, "id", "modulo_id");
    }
}
