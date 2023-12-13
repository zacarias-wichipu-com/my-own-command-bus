<?php

declare(strict_types=1);

namespace App;

use App\Command\AwakeCommand;
use App\Command\Command;
use App\Command\SleepCommand;
use App\Handler\AwakeHandler;
use App\Handler\Handler;
use App\Handler\ShowTimeHandler;
use App\Handler\SleepHandler;

final class HandlerDriver
{
    public function __invoke(Command $command): Handler
    {
        return match ($command::class) {
            AwakeCommand::class => new AwakeHandler(new SpanishDisplayMessage()),
            SleepCommand::class => new SleepHandler(new SpanishDisplayMessage()),
            default => new ShowTimeHandler(),
        };
    }
}
