<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
            "title" => "required|string|min:5|max:255",
            "content" => "required",
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "status" => "required",
            "publish_date" => "required",
        ];
    }
}
