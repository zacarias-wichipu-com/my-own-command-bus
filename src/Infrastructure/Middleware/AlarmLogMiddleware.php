<?php

declare(strict_types=1);

namespace App\Infrastructure\Middleware;

use App\Application\PlayAlarmCommand;
use App\Domain\Bus\Command\Command;
use App\Domain\Bus\Middleware\Middleware;
use App\Infrastructure\Bus\CommandBus;
use DateTimeImmutable;

use function dirname;
use function fclose;
use function fopen;
use function fwrite;
use function sprintf;

final class AlarmLogMiddleware implements Middleware
{
    public function __invoke(Command $command, CommandBus $commandBus): void
    {
        $commandBus->handle($command);
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
