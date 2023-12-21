<?php

declare(strict_types=1);

namespace App\Domain\Event;

use App\Domain\Message\DomainEvent;

final readonly class DotHourReachedDomainEvent implements DomainEvent
{
    public function __construct(
        private int $hour,
        private int $awakeTime,
    ) {
    }

    public function hour(): int
    {
        return $this->hour;
    }

    public function awakeTime(): int
    {
        return $this->awakeTime;
    }
}
