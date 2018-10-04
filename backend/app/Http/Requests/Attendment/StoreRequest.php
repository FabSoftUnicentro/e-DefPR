<?php

namespace App\Http\Requests\Attendment;

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
            'description' => 'required|string',
            'type_id' => 'required|numeric',
            'assisted_id' => 'required|numeric',
            //user_id' => 'sometimes|numeric'
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
            'user_id' => 'trim|escape',
            'assisted_id' => 'trim|escape'
        ];
    }
}
