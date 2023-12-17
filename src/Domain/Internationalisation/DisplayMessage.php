<?php

declare(strict_types=1);

namespace App\Domain\Internationalisation;

interface DisplayMessage
{
    public function goodMorning(): string;

    public function goodNight(): string;
}
