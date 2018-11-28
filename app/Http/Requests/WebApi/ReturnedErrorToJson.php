<?php

namespace App\Http\Requests\WebApi;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ReturnedErrorToJson
{
    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        info($validator->errors());
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}