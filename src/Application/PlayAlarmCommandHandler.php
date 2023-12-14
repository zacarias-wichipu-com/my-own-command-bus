<?php

declare(strict_types=1);

namespace App\Application;

use App\ClockSpeaker;
use App\SoundBank;
use InvalidArgumentException;

final readonly class PlayAlarmCommandHandler implements CommandHandler
{
    private ClockSpeaker $clockSpeaker;

    public function __construct()
    {
        $this->clockSpeaker = new ClockSpeaker();
    }

    public function __invoke(Command $command): void
    {
        $this->ensureCommand($command);
        $this->clockSpeaker->play(SoundBank::alarm->value);
    }

    private function ensureCommand(Command $command): void
    {
        if (!$command instanceof PlayAlarmCommand) {
            throw new InvalidArgumentException(sprintf('Invalid command <$1%s>', $command::class));
        }
    }
}
