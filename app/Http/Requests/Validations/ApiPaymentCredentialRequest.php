<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class ApiPaymentCredentialRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->header('APPKEY') === config('app.phza24_api_key');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
