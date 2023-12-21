<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Event\AwakeHourReachedDomainEvent;
use App\Domain\Event\DotHourReachedDomainEvent;
use App\Domain\Event\SleepHourReachedDomainEvent;
use App\Domain\Message\DomainEvent;

final class Clock
{
    private array $domainEvents;

    public function __construct(
        private int $seconds,
        private readonly int $awakeAt,
        private readonly int $sleepAt
    ) {
        $this->domainEvents = [];
    }

    public function tick(): void
    {
        $this->seconds = $this->seconds >= 86400 ? 0 : ++$this->seconds;
        if ($this->second() !== 0 || $this->minute() !== 0) {
            return;
        }
        $this->notify(new DotHourReachedDomainEvent($this->hour()));
        if ($this->hour() === $this->awakeAt) {
            $this->notify(new AwakeHourReachedDomainEvent($this->hour()));
        }
        if ($this->hour() === $this->sleepAt) {
            $this->notify(new SleepHourReachedDomainEvent($this->hour()));
        }
    }

    public function events(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];
        return $domainEvents;
    }

    private function notify(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }

    private function second(): int
    {
        return ($this->seconds % 3600) % 60;
    }

    private function minute(): int
    {
        return ($this->seconds % 3600) / 60;
    }

    private function hour(): int
    {
        return $this->seconds / 3600;
    }
}
