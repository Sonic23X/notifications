<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'notification' => new NotificationResource($this->whenLoaded('notification')),
            'user' => new UserResource($this->whenLoaded('user')),
            'sent_at' => $this->sent_at,
        ];
    }
}
