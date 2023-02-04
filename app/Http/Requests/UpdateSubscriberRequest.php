<?php

namespace App\Http\Requests;

use App\DataTransferObjects\StoreSubscriberDTO;
use App\DataTransferObjects\UpdateSubscriberDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSubscriberRequest extends FormRequest
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

    public function rules()
    {
        return [
            "name" => "required|string|min:3|max:255",
            "password" => "nullable|min:8",
            "status" => "required",
        ];
    }

    public function toDTO(): UpdateSubscriberDTO
    {
        return new UpdateSubscriberDTO($this->name, ($this->password? $this->password : ''), $this->status);
    }
}
