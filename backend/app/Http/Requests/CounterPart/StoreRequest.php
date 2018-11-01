<?php

namespace App\Http\Requests\CounterPart;

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
            'email' => 'required|email|unique:counterPart',
            'birth_date' => 'required',
            'rg' => 'nullable|string',
            'gender' => 'sometimes',
            'rg_issuer' => 'nullable',
            'profession' => 'nullable|string',
            'note' => 'nullable|string',
            'addresses' => 'required',
             'document_type'=>'required|string',
            'document_number'=>'required',
            'fantasy_name'=>'nullable|string'
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
            'document_number' => 'trim',
            'note' => 'trim|escape',
        ];
    }
}
