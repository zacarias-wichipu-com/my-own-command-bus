<?php

declare(strict_types=1);

namespace App;

final readonly class ClockDisplay
{
    public function update(string $message): void
    {
        printf('------------------------' . PHP_EOL);
        printf($message . PHP_EOL);
    }
}
