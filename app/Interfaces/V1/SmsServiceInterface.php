<?php

namespace App\Interfaces\V1;

use App\Http\Resources\V1\NotificationResource;

interface SmsServiceInterface
{
    public function sendSms(array $user, NotificationResource $notification): bool;
}
