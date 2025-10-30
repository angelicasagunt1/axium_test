<?php

namespace App\Exception;

class DuplicatedCodeException extends \RuntimeException
{
    public function __construct(string $code)
    {
        parent::__construct("Ya existe un producto o servicio con el código '{$code}'");
    }
}