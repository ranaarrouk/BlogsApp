<?php

namespace App\Http\Requests;

use App\DataTransferObjects\StoreSubscriberDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSubscriberRequest extends FormRequest
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
            "name" => "required|string|min:3|max:255",
            "username" => "required|unique:users",
            "password" => "required|min:8",
            "status" => "required",
        ];
    }

    public function toDTO(): StoreSubscriberDTO
    {
        return new StoreSubscriberDTO($this->name, $this->username, $this->password, $this->status, 'subscriber');
    }
}
