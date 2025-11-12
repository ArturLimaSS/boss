<?php

namespace App\Domain\Usuario\Entity;

use App\Domain\Entity;
use App\Domain\ValueObjects\RandomInitialPasswordMaker;

class Usuario extends Entity
{
    protected $name;

    protected $email;

    protected RandomInitialPasswordMaker $password;

    public function __construct(array $dados)
    {
        $this->name     = $dados["name"] ?? null;
        $this->email    = $dados["email"] ?? null;
        $this->password = new RandomInitialPasswordMaker($dados);
    }

    public function password()
    {
        return $this->password;
    }

    public function email()
    {
        return $this->email;
    }
}
