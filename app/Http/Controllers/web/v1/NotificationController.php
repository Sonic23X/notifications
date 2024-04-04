<?php

namespace App\Http\Controllers\web\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CreateNotificationRequest;
use App\Repositories\V1\NotificationRepository;
use App\Repositories\V1\CategoryRepository;
use App\Repositories\V1\UserRepository;
use App\Enums\NotificationType;
use App\Services\V1\EmailService;
use App\Services\V1\PushNotificationService;
use App\Services\V1\SmsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class NotificationController extends Controller
{

    public function __construct(
        protected NotificationRepository $notificationRepository,
        protected CategoryRepository $categoryRepository,
        protected UserRepository $userRepository,
        protected EmailService $emailService,
        protected PushNotificationService $pushNotificationService,
        protected SmsService $smsService)
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

            $notification = $this->notificationRepository->create($request->validated());

            $users = $this->userRepository->getUsersToBeNotificated($notification['type'], $notification['category']->id);

            // Send notification to the specific users based on the channel
            foreach ($users as $user) {
                if (in_array(NotificationType::Email->value, $user['channels'])) {
                    $this->emailService->sendEmail($user, $notification);
                } else if (in_array(NotificationType::Push->value, $user['channels'])) {
                    $this->pushNotificationService->sendPushNotification($user, $notification);
                } else if (in_array(NotificationType::Sms->value, $user['channels'])) {
                    $this->smsService->sendSms($user, $notification);
                } else {
                    Log::info('User ' . $user['id'] . ' has no channels to be notified');
                }
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
