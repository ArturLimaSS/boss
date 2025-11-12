<?php

namespace App\Domain\ValueObjects;

use Illuminate\Support\Facades\Hash;

class RandomInitialPasswordMaker
{
    public $password;

    public function __construct($dados)
    {
        if (isset($dados["password"])) {
            $this->password = $dados["password"];
        } else {
            $this->password = random_int(100000, 999999);
        }
    }

    public function value()
    {
        return $this->password;
    }

    public function toHash()
    {
        return Hash::make($this->password);
    }
}
