<?php

namespace App\Repositories\V1;

use App\Http\Resources\V1\NotificationResource;
use App\Interfaces\V1\NotificationInterface;
use App\Models\V1\Notification;
use App\Repositories\V1\CategoryRepository;

class NotificationRepository implements NotificationInterface
{
    public function __construct(
        protected CategoryRepository $categoryRepository)
    {
    }

    // To-DO: Revisar porque no se está retornando correctamente el CategoryResource
    // Posiblemente por cambio en la versión de Laravel
    public function all()
    {
        return NotificationResource::collection(Notification::all());
    }

    public function findOne(string $uuid)
    {
        return NotificationResource::make(Notification::where('uuid', $uuid)->firstOrFail());
    }

    public function create(array $data): NotificationResource
    {
        $notificationData = [
            'content' => $data['content'],
            'category_id' => $this->categoryRepository->findOne($data['category'])->id,
            'type' => $data['type'],
        ];

        $notification = Notification::create($notificationData);

        return NotificationResource::make($notification->load('category'));
    }

    public function getInternalId(string $uuid): int
    {
        return Notification::where('uuid', $uuid)->firstOrFail()->id;
    }
}
