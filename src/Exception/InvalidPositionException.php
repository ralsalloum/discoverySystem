<?php

namespace App\Exception;

class InvalidPositionException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid position for rover movement');
    }
}
