<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Clock;
use App\Domain\Message\CommandHandler;
use App\Domain\Message\PublisherBus;
use App\Domain\SecondsRepository;

final readonly class TickCommandHandler implements CommandHandler
{
    public function __construct(
        private PublisherBus $bus,
        private SecondsRepository $secondsRepository
    ) {
    }

    public function __invoke(TickCommand $command): void
    {
        $clock = new Clock(
            seconds: $this->secondsRepository->get(),
            awakeAt: $command->awakeAt(),
            sleepAt: $command->sleepAt()
        );
        $clock->tick();
        $this->secondsRepository->persist($clock->seconds());
        $this->bus->publishEvents($clock->events());
    }
}
