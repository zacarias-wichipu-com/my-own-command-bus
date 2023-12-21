<?php

declare(strict_types=1);

namespace App\Domain;

interface SecondsRepository
{
    public function get(): int;

    public function persist(int $seconds): void;
}
