<?php

declare(strict_types=1);

namespace App\Domain\Event;

use App\Domain\Message\DomainEvent;

final readonly class AwakeHourReachedDomainEvent implements DomainEvent
{
    public function __construct(
        private int $hour,
    ) {
    }

    public function hour(): int
    {
        return $this->hour;
    }
}
