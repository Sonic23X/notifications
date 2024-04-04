<?php

namespace App\Repositories\V1;

use App\Http\Resources\V1\UserResource;
use App\Interfaces\V1\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    public function findOne(string $uuid) {
        return UserResource::make(User::where('uuid', $uuid)->firstOrFail());
    }

    public function getUsersToBeNotificated(string $type, int $category)
    {
        return UserResource::collection(
            User::whereJsonContains('suscribed_to', $category)
                ->whereJsonContains('channels', $type)
                ->get()
        )->resolve();
    }

    public function getInternalId(string $uuid): int
    {
        return User::where('uuid', $uuid)->firstOrFail()->id;
    }
}
