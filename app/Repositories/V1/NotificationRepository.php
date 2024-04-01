<?php

namespace App\Repositories\V1;

use App\Http\Resources\V1\NotificationResource;
use App\Interfaces\V1\NotificationInterface;
use App\Models\V1\Notification;

class NotificationRepository implements NotificationInterface
{
    public function all(): NotificationResource {
        return NotificationResource::make(Notification::all());
    }

    public function create(array $data): NotificationResource {
        return NotificationResource::make(Notification::create($data));
    }
}
