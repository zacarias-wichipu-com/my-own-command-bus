<?php

declare(strict_types=1);

namespace App\Infrastructure\EntryPoint;

use App\Application\DisplayAwakeMessageCommand;
use App\Application\DisplaySleepMessageCommand;
use App\Application\DisplayTimeCommand;
use App\Application\PlayAlarmCommand;
use App\Application\PlayBeepCommand;
use App\Domain\Clock;
use App\Domain\Event\DomainEvent;
use App\Infrastructure\Bus\CommandBus;

final readonly class RunClock
{
    public function __construct(
        private CommandBus $commandBus,
        private int $awakeAt,
        private int $sleepAt,
    ) {
    }

    public function __invoke(): void
    {
        $clock = new Clock(0, $this->awakeAt, $this->sleepAt);
        do {
            $clock->tick();
            $events = $clock->events();
            array_walk(
                array: $events,
                callback: static fn(DomainEvent $domainEvent) => printf(
                    'events at %2$d: %1$s' . PHP_EOL,
                    $domainEvent::class,
                    $domainEvent->hour()
                )
            );
        } while (true);
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
            $this->awakeAt => new PlayAlarmCommand(),
            default => new PlayBeepCommand()
        };
        ($this->commandBus)($command);
    }
}
