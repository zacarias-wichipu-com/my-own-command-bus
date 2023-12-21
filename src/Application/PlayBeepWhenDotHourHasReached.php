<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Component\ClockSpeaker;
use App\Domain\Event\DotHourReachedDomainEvent;
use App\Domain\Message\DomainEventHandler;
use App\Infrastructure\Sound\SoundBank;

final readonly class PlayBeepWhenDotHourHasReached implements DomainEventHandler
{
    private ClockSpeaker $clockSpeaker;

    public function __construct()
    {
        $this->clockSpeaker = new ClockSpeaker();
    }

    public function __invoke(DotHourReachedDomainEvent $domainEvent): void
    {
        $this->clockSpeaker->play(SoundBank::beep->value);
    }
}
