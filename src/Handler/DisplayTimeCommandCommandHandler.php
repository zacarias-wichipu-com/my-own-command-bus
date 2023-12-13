<?php

declare(strict_types=1);

namespace App\Handler;

use App\ClockDisplay;
use App\Command\Command;
use App\Command\DisplayTimeCommand;
use InvalidArgumentException;

use function str_pad;

final readonly class DisplayTimeCommandCommandHandler implements CommandHandler
{
    private ClockDisplay $clockDisplay;

    public function __construct()
    {
        $this->clockDisplay = new ClockDisplay();
    }

    public function __invoke(Command $command): void
    {
        $this->ensureCommand($command);
        $this->clockDisplay->update(
            message: $this->buildDisplayMessage((string)$command->hour())
        );
    }

    private function ensureCommand(Command $command): void
    {
        if (!$command instanceof DisplayTimeCommand) {
            throw new InvalidArgumentException(sprintf('Invalid command <$1%s>', $command::class));
        }
    }

    private function buildDisplayMessage(string $hour): string
    {
        return sprintf(
            '%1$s:00',
            str_pad(
                string: $hour,
                length: 2,
                pad_string: '0',
                pad_type: STR_PAD_LEFT
            )
        );
    }
}
