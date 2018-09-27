<?php

namespace App\Http\Requests;

class AttendmentStoreRequest extends BaseRequest
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
            'description' => 'required|String',
            'type_id' => 'required|numeric'
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
            'description' => 'trim|capitalize|escape',
            'type_id' => 'trim|escape',
            'user_id' => 'trim|escape'
        ];
    }
}
