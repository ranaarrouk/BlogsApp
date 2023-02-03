<?php

namespace App\Http\Requests;

use App\DataTransferObjects\StoreBlogDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin();
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

    public function toDto(): StoreBlogDTO
    {
        $imageName = "";
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $file->store('public\blogs\images');
            $imageName = $file->hashName();
        }
        return new StoreBlogDTO($this->title, $this->input("content"), $imageName, $this->status, $this->publish_date);
    }
}
