<?php


namespace App\Actions;


use App\DataTransferObjects\StoreSubscriberDTO;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreSubscriberAction
{
    public function execute(StoreSubscriberDTO $subscriberDTO)
    {
        $user = User::create([
            'name' => $subscriberDTO->name,
            'username' => $subscriberDTO->username,
            'password' => Hash::make($subscriberDTO->password),
            'status' => $subscriberDTO->status,
            'type' => $subscriberDTO->type,
        ]);
        $user->refresh();
    }
}
