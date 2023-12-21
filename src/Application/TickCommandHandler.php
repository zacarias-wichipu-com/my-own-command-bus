<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Clock;
use App\Domain\Message\CommandHandler;
use App\Domain\Message\PublisherBus;

final readonly class TickCommandHandler implements CommandHandler
{
    public function __construct(
        private PublisherBus $bus
    ) {
    }

    public function __invoke(TickCommand $command): void
    {
        $clock = new Clock(
            seconds: 0,
            awakeAt: $command->awakeAt(),
            sleepAt: $command->sleepAt()
        );
        $clock->tick();
        $this->bus->publishEvents($clock->events());
    }
}
