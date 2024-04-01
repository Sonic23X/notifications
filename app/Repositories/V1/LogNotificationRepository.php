<?php

namespace App\Repositories\V1;

use App\Http\Resources\V1\LogNotificationResource;
use App\Interfaces\V1\LogNotificationInterface;
use App\Models\V1\LogNotification;
use App\Repositories\V1\NotificationRepository;
use App\Repositories\V1\UserRepository;

class LogNotificationRepository implements LogNotificationInterface
{
    public function __construct(
        protected NotificationRepository $notificationRepository,
        protected UserRepository $userRepository)
    {
    }

    public function all()
    {
        return LogNotificationResource::collection(LogNotification::all())->resolve();
    }

    public function create(string $notification, string $user)
    {
        $notification = $this->notificationRepository->findOne($notification);
        $user = $this->userRepository->findOne($user);

        return LogNotificationResource::make(LogNotification::create([
            'notification_id' => $notification['id'],
            'user_id' => $user['id'],
        ]))->resolve();
    }
}
