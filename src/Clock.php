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
        foreach (range(0, 23) as $hour) {
            $this->clockDisplay->show(
                command: new ShowTimeCommand($hour)
            );
        }
    }
}
