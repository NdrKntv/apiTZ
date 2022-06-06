<?php

namespace App\Exceptions;

use Exception;

class ModelFoundFailsException extends Exception
{
    private $model;
    private $identifier;

    public function __construct($model, $identifier)
    {
        $this->model = $model;
        $this->identifier = $identifier;
    }

    public function render()
    {
        return response()->apiResponse(['message' => 'The ' . $this->model . ' with the requested identifier does not exist',
            'fails' => [$this->identifier => [ucfirst($this->model) . ' not found']]], 404);
    }
}
