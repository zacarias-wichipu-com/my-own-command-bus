<?php

declare(strict_types=1);

namespace App;

interface DisplayMessage
{
    public function goodMorning(): string;

    public function goodNight(): string;
}
