<?php

declare(strict_types=1);

namespace App\Infrastructure\Middleware;

use App\Application\Command;
use App\Application\PlayAlarmCommand;
use App\Domain\Event\DomainEvent;
use App\Infrastructure\Bus\CommandBus;
use App\Infrastructure\Bus\DomainEventBus;
use DateTimeImmutable;

use function dirname;
use function fclose;
use function fopen;
use function fwrite;
use function sprintf;

final class AlarmLogMiddleware extends AbstractMiddleware
{
    public function __invoke(Command|DomainEvent $command, CommandBus|DomainEventBus $commandBus): void
    {
        $this->handle($command, $commandBus);
        $this->logAlarm($command);
    }

    private function logAlarm(Command $command): void
    {
        if (!$command instanceof PlayAlarmCommand) {
            return;
        }
        $log = fopen(
            filename: dirname(__DIR__) . '/../../var/alarm.log',
            mode: 'ab'
        );
        fwrite(
            stream: $log,
            data: sprintf(
                '%1$s: play alarm' . PHP_EOL,
                (new DateTimeImmutable())->format('Y-m-d H:i:s'),
            )
        );
        fclose($log);
    }
}
