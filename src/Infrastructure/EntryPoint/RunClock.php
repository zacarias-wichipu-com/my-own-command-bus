<?php

declare(strict_types=1);

namespace App\Infrastructure\EntryPoint;

use App\Application\DisplayAwakeMessageCommand;
use App\Application\DisplaySleepMessageCommand;
use App\Application\DisplayTimeCommand;
use App\Application\PlayAlarmCommand;
use App\Application\PlayBeepCommand;
use App\Application\TickCommand;
use App\Domain\Clock;
use App\Domain\Message\HandlerBus;
use App\Domain\Message\DomainEvent;
use App\Domain\Message\PublisherBus;
use App\Infrastructure\Bus\CommandBus;

final readonly class RunClock
{
    public function __construct(
        private HandlerBus $bus,
        private int $awakeAt,
        private int $sleepAt,
    ) {
    }

    public function __invoke(): void
    {
        do {
            $this->bus->handle(
                message: new TickCommand(
                    awakeAt: $this->awakeAt,
                    sleepAt: $this->sleepAt
                )
            );
        } while (true);
    }
}
