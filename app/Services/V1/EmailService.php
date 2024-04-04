<?php

namespace App\Services\V1;

use App\Http\Resources\V1\NotificationResource;
use App\Interfaces\V1\EmailServiceInterface;
use App\Repositories\V1\LogNotificationRepository;
use Illuminate\Support\Facades\Log;

class EmailService implements EmailServiceInterface
{
    public function __construct(
        protected LogNotificationRepository $logNotificationRepository)
    {
    }

    public function sendEmail(array $user, NotificationResource $notification): bool
    {
        try {
            // Send email
            $notification = $notification->resolve();
            Log::info('Email sent to ' . $user['email']);
            $this->logNotificationRepository->create($notification['id'], $user['id']);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
