<?php

namespace App\Services\V1;

use App\Http\Resources\V1\NotificationResource;
use App\Interfaces\V1\PushNotificationServiceInterface;
use App\Repositories\V1\LogNotificationRepository;
use Illuminate\Support\Facades\Log;

class PushNotificationService implements PushNotificationServiceInterface
{
    public function __construct(
        protected LogNotificationRepository $logNotificationRepository)
    {
    }

    public function sendPushNotification(array $user, NotificationResource $notification): bool
    {
        try {
            $notification = $notification->resolve();
            // Send push notification
            Log::info('Push notification sent to ' . $user['phone']);
            $this->logNotificationRepository->create($notification['id'], $user['id']);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
