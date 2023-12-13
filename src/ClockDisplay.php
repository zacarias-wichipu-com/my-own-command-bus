<?php

declare(strict_types=1);

namespace App;

use App\Command\Command;

final readonly class ClockDisplay
{
    private HandlerDriver $resolver;

    public function __construct()
    {
        $this->resolver = new HandlerDriver();
    }

    public function update(Command $command): void
    {
        $handler = ($this->resolver)(command: $command);
        ($handler)(command: $command);
    }
}
