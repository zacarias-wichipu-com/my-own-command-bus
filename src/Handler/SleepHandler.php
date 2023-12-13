<?php

declare(strict_types=1);

namespace App\Handler;

use App\Command\Command;
use App\Command\SleepCommand;
use App\DisplayMessage;
use InvalidArgumentException;

use function printf;
use function str_pad;

final readonly class SleepHandler implements Handler
{
    public function __construct(
        private DisplayMessage $message
    ) {
    }

    public function __invoke(Command $command): void
    {
        $this->ensureCommand($command);
        printf(
            '%1$s:00 <%2$s>' . PHP_EOL,
            str_pad(
                string: (string)$command->hour(),
                length: 2,
                pad_string: '0',
                pad_type: STR_PAD_LEFT
            ),
            $this->message->goodNight()
        );
    }

    private function ensureCommand(Command $command): void
    {
        if (!$command instanceof SleepCommand) {
            throw new InvalidArgumentException(sprintf('Invalid command <$1%s>', $command::class));
        }
    }

}
