<?php

namespace App\Interfaces\V1;

interface LogNotificationInterface
{
    public function all();

    public function create(string $notification, string $user);
}
