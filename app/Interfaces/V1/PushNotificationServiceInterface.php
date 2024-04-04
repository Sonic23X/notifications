<?php

namespace App\Interfaces\V1;

use App\Http\Resources\V1\NotificationResource;

interface PushNotificationServiceInterface
{
    public function sendPushNotification(array $user, NotificationResource $notification): bool;
}
