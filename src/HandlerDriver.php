<?php

declare(strict_types=1);

namespace App;

use App\Application\Command;
use App\Application\CommandHandler;
use App\Application\DisplayAwakeMessageCommand;
use App\Application\DisplayAwakeMessageCommandCommandHandler;
use App\Application\DisplaySleepMessageCommand;
use App\Application\DisplaySleepMessageCommandCommandHandler;
use App\Application\DisplayTimeCommandCommandHandler;

final class HandlerDriver
{
    public function __invoke(Command $command): CommandHandler
    {
        return match ($command::class) {
            DisplayAwakeMessageCommand::class => new DisplayAwakeMessageCommandCommandHandler(
                new SpanishDisplayMessage()
            ),
            DisplaySleepMessageCommand::class => new DisplaySleepMessageCommandCommandHandler(
                new SpanishDisplayMessage()
            ),
            default => new DisplayTimeCommandCommandHandler(),
        };
    }
}
