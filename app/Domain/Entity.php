<?php

namespace App\Domain;

class Entity
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
