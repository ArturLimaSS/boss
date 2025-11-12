<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class BaseModel extends Model
{
    // ... suas outras definições

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Uuid::uuid4();
        });
    }
}
