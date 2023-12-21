<?php

declare(strict_types=1);

namespace App\Infrastructure\Middleware;

use App\Domain\Message\Command;
use App\Domain\Message\DomainEvent;
use App\Infrastructure\Bus\CommandBus;
use App\Infrastructure\Bus\DomainEventBus;
use DateTimeImmutable;

use function dirname;
use function fclose;
use function fopen;
use function fwrite;
use function sprintf;

final class CommandLoggerMiddleware extends AbstractMiddleware
{
    public function __invoke(Command|DomainEvent $message, CommandBus|DomainEventBus $bus): void
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
                $message::class
            )
        );
        $this->handle($message, $bus);
        fwrite(
            stream: $log,
            data: sprintf(
                '%1$s: %2$s finished' . PHP_EOL,
                (new DateTimeImmutable())->format('Y-m-d H:i:s'),
                $message::class
            )
        );
        fclose($log);
    }
}
