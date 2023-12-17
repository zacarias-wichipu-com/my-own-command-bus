<?php

declare(strict_types=1);

namespace App\Infrastructure\Sound;

enum SoundBank: string
{
    case beep = '🤖';
    case alarm = '🔔';
}
