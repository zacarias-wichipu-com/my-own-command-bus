<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Domain\Bus\Command\Command;
use App\Domain\Bus\Command\CommandHandler;

final class CommandHandlerDriver
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
