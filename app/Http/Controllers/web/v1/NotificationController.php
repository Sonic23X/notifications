<?php

namespace App\Http\Controllers\web\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CreateNotificationRequest;
use App\Repositories\NotificationRepository;
use App\Repositories\CategoryRepository;
use App\Enums\NotificationType;
use Inertia\Inertia;
use Inertia\Response;

class NotificationController extends Controller
{

    public function __construct(
        protected NotificationRepository $notificationRepository,
        protected CategoryRepository $categoryRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('V1/Notification/Index',
            [
                'notificationCollection' => $this->notificationRepository->all()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('V1/Notification/Create',
            [
                'notificationCollection' => $this->categoryRepository->all(),
                'typeCollection' => NotificationType::getValues()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNotificationRequest $request)
    {
        //
    }
}
