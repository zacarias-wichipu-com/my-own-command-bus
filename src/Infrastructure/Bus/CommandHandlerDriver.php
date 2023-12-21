<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Domain\Message\Command;
use App\Domain\Message\CommandHandler;

final class CommandHandlerDriver
{
    /**
     * @var array<string, \App\Application\CommandHandler>
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
