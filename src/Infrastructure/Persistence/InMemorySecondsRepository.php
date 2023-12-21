<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Clock;
use App\Domain\SecondsRepository;

final class InMemorySecondsRepository implements SecondsRepository
{

    private int $seconds;

    public function __construct(
    ) {
        $this->seconds = 0;
    }

    public function get(): int
    {
        return $this->seconds;
    }

    public function persist(int $seconds): void
    {
        $this->seconds = $seconds;
    }
}
