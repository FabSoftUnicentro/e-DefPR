<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class AuthenticateRequest extends BaseRequest
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
            'login' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * Custom messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'login.required' => 'O campo login é obrigatório.',
            'password.required' => 'O campo password é obrigatório.'
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
            'login' => 'trim|lowercase',
        ];
    }
}
