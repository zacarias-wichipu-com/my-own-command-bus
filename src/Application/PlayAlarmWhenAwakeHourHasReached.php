<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Component\ClockSpeaker;
use App\Domain\Event\AwakeHourReachedDomainEvent;
use App\Domain\Event\DotHourReachedDomainEvent;
use App\Domain\Message\DomainEventHandler;
use App\Domain\Message\HandlerBus;
use App\Infrastructure\Bus\CommandBus;
use App\Infrastructure\Sound\SoundBank;

final readonly class PlayAlarmWhenAwakeHourHasReached implements DomainEventHandler
{
    public function __construct(
        private HandlerBus $bus
    ) {
    }

    public function __invoke(AwakeHourReachedDomainEvent $domainEvent): void
    {
        $this->bus->handle(new PlayAlarmCommand());
    }
}
