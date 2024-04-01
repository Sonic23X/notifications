<?php

namespace App\Enums;

enum NotificationType: string
{
    case Sms = 'sms';
    case Email = 'email';
    case Push = 'push_notification';

    public static function getAllValuesAsString(): string
    {
        return implode(',', [
            self::Sms,
            self::Email,
            self::Push,
        ]);
    }

    public static function getValues(): array
    {
        return [
            self::Sms,
            self::Email,
            self::Push,
        ];
    }
}
