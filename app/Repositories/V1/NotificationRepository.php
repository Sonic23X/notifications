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

    public function create(array $data): NotificationResource
    {
        $notification = [
            'content' => $data['content'],
            'category_id' => $this->categoryRepository->findOne($data['category'])->id,
            'type' => $data['type'],
        ];

        return NotificationResource::make(Notification::create($notification));
    }
}
