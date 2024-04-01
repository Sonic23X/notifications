<?php

namespace App\Http\Controllers\web\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CreateNotificationRequest;
use App\Repositories\V1\NotificationRepository;
use App\Repositories\V1\CategoryRepository;
use App\Repositories\V1\UserRepository;
use App\Repositories\V1\LogNotificationRepository;
use App\Enums\NotificationType;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class NotificationController extends Controller
{

    public function __construct(
        protected NotificationRepository $notificationRepository,
        protected CategoryRepository $categoryRepository,
        protected UserRepository $userRepository,
        protected LogNotificationRepository $logNotificationRepository)
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
                'categoryCollection' => $this->categoryRepository->all(),
                'typeCollection' => NotificationType::getValues()
            ]);
    }

    /**
     * Store a newly created resource in storage and send to specific users.
     */
    public function store(CreateNotificationRequest $request)
    {
        try {
            DB::beginTransaction();

            $notification = $this->notificationRepository->create($request->validated())->resolve();

            $users = $this->userRepository->getUsersToBeNotificated($notification['type'], $notification['category']->id);

            // FAKE: Simulación de envío de notificaciones a los usuarios obtenidos,
            // se crea un registro en la tabla log_notifications por cada usuario "notificado"
            foreach ($users as $user) {
                $this->logNotificationRepository->create($notification['id'], $user['id']);
            }

            DB::commit();
            // TO-DO: revisar porque se regresa un json en lugar de un Inertia Page
            // Uso de Axios en lugar de Inertia
            //return Redirect::route('notification.index');

            return response()->json(['message' => 'Notification created and sent successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error creating notification'], 500);
        }
    }
}
