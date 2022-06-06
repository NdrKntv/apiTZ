<?php

namespace App\Traits;

use App\Exceptions\FailedValidationException;
use Illuminate\Support\Facades\Validator;

trait UrlParamsValidation
{
    public function urlPramsValidation(array $parameterNameValue, array $rules, $statusCode = 400)
    {
        $validation = Validator::make($parameterNameValue, $rules);
        throw_if($validation->fails(), new FailedValidationException($validation->messages(), $statusCode));
    }

    public function paginationValidation()
    {
        $this->urlPramsValidation(['page' => request('page'), 'count' => request('count')],
            ['page' => 'nullable|integer|min:1', 'count' => 'nullable|integer|min:1'], 422);
    }
}
