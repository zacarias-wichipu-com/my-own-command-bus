<?php

declare(strict_types=1);

namespace App;

use App\Application\DisplayAwakeMessageCommand;
use App\Application\DisplaySleepMessageCommand;
use App\Application\DisplayTimeCommand;

final readonly class Clock
{
    private CommandBus $commandBus;

    public function __construct(
        private int $awakeAt,
        private int $sleepAt,
    ) {
        $this->commandBus = new CommandBus();
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
        $command = match ($hour) {
            $this->awakeAt => new DisplayAwakeMessageCommand(hour: $hour),
            $this->sleepAt => new DisplaySleepMessageCommand(hour: $hour),
            default => new DisplayTimeCommand(hour: $hour)
        };
        ($this->commandBus)($command);
    }
}
