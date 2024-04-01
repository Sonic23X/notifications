<?php

namespace App\Repositories;

use App\Http\Resources\V1\NotificationResource;
use App\Interfaces\V1\NotificationInterface;
use App\Models\V1\Notification;

class NotificationRepository extends NotificationInterface
{
    public function all() {
        return NotificationResource::collection(Notification::all());
    }

    public function create(array $data) {
        return NotificationResource::make(Notification::create($data));
    }
}
