<?php

namespace App\Http\Requests;

use App\DataTransferObjects\StoreBlogDTO;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class StoreBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "title" => "required|string|min:5|max:255",
            "content" => "required",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "status" => "required",
            "publish_date" => "required|date",
        ];
    }

    public function toDto(): StoreBlogDTO
    {
        return new StoreBlogDTO($this->title, $this->content, $this->image, $this->status, $this->publish_date);
    }
}
