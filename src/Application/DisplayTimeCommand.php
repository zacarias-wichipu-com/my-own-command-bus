<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Bus\Command\Command;

final readonly class DisplayTimeCommand implements Command
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
