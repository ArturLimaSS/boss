<?php

namespace App\Domain\ValueObjects;

use Ramsey\Uuid\Uuid;

class UniqueEntityID
{
    protected string $id;

    public function __construct($id = null)
    {
        if (is_string($id)) {
            $this->id = $id;

            return;
        }

        // Se passou array com id
        if (is_array($id) && isset($id['id'])) {
            $this->id = $id['id'];

            return;
        }

        // Se não passou nada, gera
        $this->id = Uuid::uuid4()->toString();
    }

    public function value(): string
    {
        return $this->id;
    }
}
