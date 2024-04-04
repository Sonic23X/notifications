<?php

namespace App\Services\V1;

use App\Http\Resources\V1\NotificationResource;
use App\Interfaces\V1\SmsServiceInterface;
use App\Repositories\V1\LogNotificationRepository;
use Illuminate\Support\Facades\Log;

class SmsService implements SmsServiceInterface
{
    public function __construct(
        protected LogNotificationRepository $logNotificationRepository)
    {
    }

    public function sendSms(array $user, NotificationResource $notification): bool
    {
        try {
            $notification = $notification->resolve();
            // Send sms
            Log::info('Sms sent to ' . $user['phone']);
            $this->logNotificationRepository->create($notification['id'], $user['id']);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
