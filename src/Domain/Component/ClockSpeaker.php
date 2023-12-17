<?php

declare(strict_types=1);

namespace App\Domain\Component;

final readonly class ClockSpeaker
{
    public function play(string $sound): void
    {
        printf('🔈 : <%1$s>' . PHP_EOL, $sound);
    }
}
