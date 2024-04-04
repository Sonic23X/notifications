<?php

namespace App\Repositories\V1;

use App\Http\Resources\V1\LogNotificationResource;
use App\Interfaces\V1\LogNotificationInterface;
use App\Models\V1\LogNotification;
use App\Repositories\V1\NotificationRepository;
use App\Repositories\V1\UserRepository;
use Illuminate\Support\Facades\Log;

class LogNotificationRepository implements LogNotificationInterface
{
    public function __construct(
        protected NotificationRepository $notificationRepository,
        protected UserRepository $userRepository)
    {
    }

    public function all()
    {
        return LogNotificationResource::collection(LogNotification::orderBy('created_at', 'desc')->get())->resolve();
    }

    public function create(string $notification, string $user)
    {
        Log::info($user . ' has been notified about notification ' . $notification);
        $notification = $this->notificationRepository->getInternalId($notification);
        $user = $this->userRepository->getInternalId($user);

        return LogNotificationResource::make(LogNotification::create([
            'notification_id' => $notification,
            'user_id' => $user,
        ]))->resolve();
    }
}
