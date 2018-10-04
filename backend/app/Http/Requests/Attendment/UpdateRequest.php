<?php

namespace App\Http\Requests\Attendment;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
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
            'description' => 'string',
            'type_id' => 'numeric',
            'assisted_id' => 'numeric',
            'user_id' => 'numeric'
        ];
    }
}
