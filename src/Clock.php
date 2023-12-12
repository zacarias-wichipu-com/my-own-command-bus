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
            callback: fn(int $hour) => $this->sendCommandToClockDisplay(hour: $hour)
        );
    }

    private function sendCommandToClockDisplay(int $hour): void
    {
        $this->clockDisplay->show(
            command: new ShowTimeCommand($hour)
        );
    }
}
