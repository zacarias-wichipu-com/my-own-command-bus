<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Message\Command;

final readonly class TickCommand implements Command
{
    public function __construct(
        private int $awakeAt,
        private int $sleepAt,
    ) {
    }

    public function awakeAt(): int
    {
        return $this->awakeAt;
    }

    public function sleepAt(): int
    {
        return $this->sleepAt;
    }
}
