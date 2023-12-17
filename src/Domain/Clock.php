<?php

declare(strict_types=1);

namespace App\Domain;

use App\Application\DisplayAwakeMessageCommand;
use App\Application\DisplaySleepMessageCommand;
use App\Application\DisplayTimeCommand;
use App\Application\PlayAlarmCommand;
use App\Application\PlayBeepCommand;
use App\Infrastructure\Bus\CommandBus;

final readonly class Clock
{
    public function __construct(
        private CommandBus $commandBus,
        private int $awakeAt,
        private int $sleepAt,
    ) {
    }

    public function __invoke(): void
    {
        $hours = range(start: 0, end: 23);
        array_walk(
            array: $hours,
            callback: fn(int $hour) => $this->dispatchCommand(hour: $hour)
        );
    }

    private function dispatchCommand(int $hour): void
    {
        $this->dispatchDisplayCommand($hour);
        $this->dispatchSpeakerCommand($hour);
    }

    private function dispatchDisplayCommand(int $hour): void
    {
        $command = match ($hour) {
            $this->awakeAt => new DisplayAwakeMessageCommand(hour: $hour),
            $this->sleepAt => new DisplaySleepMessageCommand(hour: $hour),
            default => new DisplayTimeCommand(hour: $hour)
        };
        ($this->commandBus)($command);
    }

    private function dispatchSpeakerCommand(int $hour): void
    {
        $command = match ($hour) {
            $this->awakeAt, $this->sleepAt => new PlayAlarmCommand(),
            default => new PlayBeepCommand()
        };
        ($this->commandBus)($command);
    }
}
