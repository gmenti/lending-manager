<?php

namespace App\Exceptions;

class InvalidAuthCredentialsException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid credentials');
    }
}
