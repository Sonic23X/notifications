<?php

namespace App\Interfaces\V1;

use App\Http\Resources\V1\NotificationResource;

interface NotificationInterface
{
    //To-DO: Revisar porque no se está retornando correctamente el NotificationResource, funcionando bien como coleccion anonima
    public function all();

    public function create(array $data): NotificationResource;
}
