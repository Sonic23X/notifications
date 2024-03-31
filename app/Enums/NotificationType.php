<?php

namespace App\Enums;

enum NotificationType: string
{
    case Sms = 'sms';
    case Email = 'email';
    case Push = 'push_notification';
}
