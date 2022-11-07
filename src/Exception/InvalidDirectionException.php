<?php

namespace App\Exception;

class InvalidDirectionException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Direction provided is not valid');
    }
}
