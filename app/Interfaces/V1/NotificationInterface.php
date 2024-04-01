<?php

namespace App\Interfaces\V1;

use App\Http\Resources\V1\NotificationResource;

interface NotificationInterface
{
    public function all(): NotificationResource;

    public function create(array $data): NotificationResource;
}
