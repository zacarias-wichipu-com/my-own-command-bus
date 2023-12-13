<?php

declare(strict_types=1);

namespace App;

use App\Command\Command;
use App\Command\DisplayAwakeMessageCommand;
use App\Command\DisplaySleepMessageCommand;
use App\Handler\CommandHandler;
use App\Handler\DisplayAwakeMessageCommandCommandHandler;
use App\Handler\DisplaySleepMessageCommandCommandHandler;
use App\Handler\DisplayTimeCommandCommandHandler;

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
