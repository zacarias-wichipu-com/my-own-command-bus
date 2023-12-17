<?php

declare(strict_types=1);

namespace App\Infrastructure\Middleware;

use App\Domain\Bus\Command\Command;
use App\Domain\Bus\Middleware\Middleware;
use App\Infrastructure\Bus\CommandBus;
use DateTimeImmutable;

use function dirname;
use function fclose;
use function fopen;
use function fwrite;
use function sprintf;

final class CommandLoggerMiddleware implements Middleware
{
    public function __invoke(Command $command, CommandBus $commandBus): void
    {
        $log = fopen(
            filename: dirname(__DIR__) . '/../../var/clock.log',
            mode: 'ab'
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
