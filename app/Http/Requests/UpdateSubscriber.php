<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriber extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            "name" => "required",
            "password" => "nullable|min:8",
            "status" => "required",
        ];
    }
}
