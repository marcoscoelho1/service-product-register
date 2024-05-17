<?php

namespace App\Exceptions;

use Exception;

class AppException extends Exception
{

    public function __construct($message = "An error occurred", $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
