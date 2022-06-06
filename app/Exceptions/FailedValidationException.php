<?php

namespace App\Exceptions;

use Exception;

class FailedValidationException extends Exception
{
    private $fails;
    private $statusCode;

    public function __construct($fails, $statusCode = 422)
    {
        $this->fails = $fails;
        $this->statusCode = $statusCode;
    }

    public function render()
    {
        return response()->apiResponse(['message' => 'Validation failed', 'fails' => $this->fails], $this->statusCode);
    }
}
