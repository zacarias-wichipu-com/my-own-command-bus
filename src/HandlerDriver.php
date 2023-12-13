<?php

declare(strict_types=1);

namespace App;

use App\Application\Command;
use App\Application\CommandHandler;

final class HandlerDriver
{
    /**
     * @var array<string, CommandHandler>
     */
    private array $commands = [];

    public function registerCommands(string $commandFqn, CommandHandler $commandHandler): void
    {
        $this->commands[$commandFqn] = $commandHandler;
    }

    public function getCommandHandlerFor(Command $command): CommandHandler
    {
        return $this->commands[$command::class];
    }
}
