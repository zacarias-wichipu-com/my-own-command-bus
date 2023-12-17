<?php

declare(strict_types=1);

namespace App\Application;

use App\ClockSpeaker;
use App\Domain\Bus\Command\CommandHandler;
use App\SoundBank;

final readonly class PlayBeepCommandHandler implements CommandHandler
{
    private ClockSpeaker $clockSpeaker;

    public function __construct()
    {
        $this->clockSpeaker = new ClockSpeaker();
    }

    public function __invoke(PlayBeepCommand $command): void
    {
        $this->clockSpeaker->play(SoundBank::beep->value);
    }
}
