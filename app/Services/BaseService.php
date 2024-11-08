<?php

namespace App\Services;

use App\Helpers\ServiceResponse;


abstract class BaseService
{
    public $sqlClass;
    public $defaultReportFileName;
    public $modulName;


    public function setResponse(int $status, string $message, $data): ServiceResponse
    {
        $response = new ServiceResponse();
        $response->status = $status;
        $response->message = $message;
        $response->data = $data;

        return $response;
    }

    public function messages(): array
    {
        return [
            'required' => 'The :attribute is required.',
            'same' => 'The :attribute and :other must match.',
            'size' => 'The :attribute must be exactly :size.',
            'between' => 'The :attribute value :input is not between :min - :max.',
            'in' => 'The :attribute must be one of the following types: :values',
            'email' => 'The :attribute must has correct format.',
            'min' => 'The :attribute field must be at least :min characters.',
            'max' => 'The :attribute field must be maximum :max characters.',
            'email.unique' => 'There is a record of the e-mail you entered..',
            'unique' => 'The :attribute field must be unique.'
        ];
    }
}
