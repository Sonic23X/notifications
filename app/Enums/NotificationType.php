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
            self::Sms->value,
            self::Email->value,
            self::Push->value,
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
