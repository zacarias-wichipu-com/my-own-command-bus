<?php

declare(strict_types=1);

namespace App\Application;

use App\ClockSpeaker;
use App\SoundBank;

final readonly class PlayAlarmCommandHandler implements CommandHandler
{
    private ClockSpeaker $clockSpeaker;

    public function __construct()
    {
        $this->clockSpeaker = new ClockSpeaker();
    }

    public function __invoke(PlayAlarmCommand $command): void
    {
        $this->clockSpeaker->play(SoundBank::alarm->value);
    }
}
