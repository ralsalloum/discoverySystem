<?php

namespace App\Exception;

class InvalidCommandException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Command provided is not valid');
    }
}
