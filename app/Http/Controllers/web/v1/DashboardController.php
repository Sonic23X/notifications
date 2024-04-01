<?php

namespace App\Http\Controllers\web\V1;

use App\Http\Controllers\Controller;
use App\Repositories\V1\LogNotificationRepository;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __construct(
        protected LogNotificationRepository $logNotificationRepository)
    {
    }

    public function index(): Response
    {
        return Inertia::render('Dashboard', [
            'LogCollection' => $this->logNotificationRepository->all()
        ]);
    }
}
