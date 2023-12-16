<?php

declare(strict_types=1);

namespace App;

use App\Application\Command;
use DateTimeImmutable;

final class CommandLoggerMiddleware implements Middleware
{
    public function __invoke(Command $command, CommandBus $commandBus): void
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
        $commandBus->handle($command);
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
