<?php

declare(strict_types=1);

namespace App\Domain\Event;

final readonly class DotHourReachedDomainEvent implements DomainEvent
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
