<?php

declare(strict_types=1);

namespace App\Command;

final readonly class ShowTimeCommand implements Command
{
    public function __construct(
        private int $hour
    ) {
    }

    public function hour(): int
    {
        return $this->hour;
    }
}
