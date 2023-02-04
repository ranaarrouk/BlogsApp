<?php


namespace App\Actions;

use App\DataTransferObjects\UpdateSubscriberDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateSubscriberAction
{
    public function execute(UpdateSubscriberDTO $subscriberDTO, $subscriber)
    {
        $subscriber = User::find($subscriber);

        $subscriber->update([
            'name' => $subscriberDTO->name,
            'status' => $subscriberDTO->status,
        ]);

        if (!empty($subscriberDTO->password))
            $subscriber->update(["password" => Hash::make($subscriberDTO->password)]);

    }
}
