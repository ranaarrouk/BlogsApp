<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlog extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required",
            "content" => "required",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "status" => "required",
            "publish_date" => "required",
        ];
    }
}
