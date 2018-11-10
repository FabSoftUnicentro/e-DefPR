<?php

namespace App\Http\Requests\Relative;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:relatives',
            'cpf' => 'required|unique:relatives',
            'birth_date' => 'required',
            'birthplace' => 'required',
            'rg' => 'required|string',
            'rg_issuer' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'profession' => 'required|string',
            'note' => 'nullable|string',
            'assisted_id' => 'required|integer',
            'addresses' => 'required'
        ];
    }

    /**
     * Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'name' => 'trim|capitalize|escape',
            'email' => 'trim|lowercase',
            'birth_date' => 'trim|format_date:d/m/Y, Y-m-d H:i:s',
            'cpf' => 'trim',
            'rg' => 'trim|escape',
            'rg_issuer' => 'trim|escape',
            'note' => 'trim|escape',
            'profession' => 'trim|escape',
        ];
    }
}
