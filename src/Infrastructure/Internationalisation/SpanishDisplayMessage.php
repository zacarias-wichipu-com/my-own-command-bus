<?php

declare(strict_types=1);

namespace App\Infrastructure\Internationalisation;

use App\Domain\Internationalisation\DisplayMessage;

final readonly class SpanishDisplayMessage implements DisplayMessage
{
    public function goodMorning(): string
    {
        return SpanishDictionary::awake->value;
    }

    public function goodNight(): string
    {
        return SpanishDictionary::sleep->value;
    }
}
