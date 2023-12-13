<?php

declare(strict_types=1);

namespace App;

use App\Command\Command;

final readonly class CommandBus
{
    private HandlerDriver $resolver;

    public function __construct()
    {
        $this->resolver = new HandlerDriver();
    }

    public function __invoke(Command $command): void
    {
        $handler = ($this->resolver)(command: $command);
        ($handler)(command: $command);
    }
}
