<?php

namespace App\Interfaces\V1;

use App\Http\Resources\V1\NotificationResource;

interface EmailServiceInterface
{
    public function sendEmail(array $user, NotificationResource $notification): bool;
}
