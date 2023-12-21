<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Component\ClockDisplay;
use App\Domain\Event\DotHourReachedDomainEvent;
use App\Domain\Message\DomainEventHandler;

final readonly class ShowDisplayTimeWhenDotHourHasReached implements DomainEventHandler
{
    private ClockDisplay $clockDisplay;

    public function __construct()
    {
        $this->clockDisplay = new ClockDisplay();
    }

    public function __invoke(DotHourReachedDomainEvent $domainEvent): void
    {
        $this->clockDisplay->update($this->buildDisplayMessage($domainEvent->hour()));
    }

    private function buildDisplayMessage(int $hour): string
    {
        return sprintf(
            '%1$s:00',
            str_pad(
                string: (string)$hour,
                length: 2,
                pad_string: '0',
                pad_type: STR_PAD_LEFT
            )
        );
    }
}
