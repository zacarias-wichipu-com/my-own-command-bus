<?php

declare(strict_types=1);

namespace App;

use App\Application\Command;
use DateTimeImmutable;

final readonly class CommandBus
{
    public function __construct(
        private CommandHandlerDriver $commandHandlerDriver
    ) {
    }

    public function __invoke(Command $command): void
    {
        $log = fopen(
            filename: dirname(__DIR__) . '/var/clock.log',
            mode: 'a'
        );
        fwrite(
            stream: $log,
            data: sprintf(
                '%1$s: Executing %2$s' . PHP_EOL,
                (new DateTimeImmutable())->format('Y-m-d H:i:s'),
                $command::class
            )
        );
        $handler = $this->commandHandlerDriver->getCommandHandlerFor(command: $command);
        ($handler)(command: $command);
        fwrite(
            stream: $log,
            data: sprintf(
                '%1$s: %2$s finished' . PHP_EOL,
                (new DateTimeImmutable())->format('Y-m-d H:i:s'),
                $command::class
            )
        );
        fclose($log);
    }
}
