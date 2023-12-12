<?php

declare(strict_types=1);

namespace App;

final readonly class Clock
{
    private ClockDisplay $clockDisplay;

    public function __construct(
        private int $awakeAt,
        private int $sleepAt,
    ) {
        $this->clockDisplay = new ClockDisplay();
    }

    public function __invoke(): void
    {
        $hours = range(start: 0, end: 23);
        array_walk(
            array: $hours,
            callback: fn(int $hour) => $this->updateClockDisplay(hour: $hour)
        );
    }

    private function updateClockDisplay(int $hour): void
    {
        $this->clockDisplay->update(
            command: match ($hour) {
                $this->awakeAt => new AwakeCommand(hour: $hour, message: new SpanishDisplayMessage()),
                $this->sleepAt => new SleepCommand(hour: $hour, message: new SpanishDisplayMessage()),
                default => new ShowTimeCommand(hour: $hour)
            }
        );
    }
}
