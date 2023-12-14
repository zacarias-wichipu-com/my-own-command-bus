<?php

declare(strict_types=1);

namespace App;

final readonly class EnglishDisplayMessage implements DisplayMessage
{
    public function goodMorning(): string
    {
        return EnglishDictionary::awake->value;
    }

    public function goodNight(): string
    {
        return EnglishDictionary::sleep->value;
    }
}
