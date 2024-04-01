<?php

namespace App\Interfaces\V1;

interface UserInterface
{
    public function findOne(string $uuid);

    public function getUsersToBeNotificated(string $type, int $category);
}
