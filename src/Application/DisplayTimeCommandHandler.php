<?php

declare(strict_types=1);

namespace App\Application;

use App\ClockDisplay;
use InvalidArgumentException;

use function str_pad;

final readonly class DisplayTimeCommandHandler implements CommandHandler
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
            message: $this->buildDisplayMessage($command->hour())
        );
    }

    private function ensureCommand(Command $command): void
    {
        if (!$command instanceof DisplayTimeCommand) {
            throw new InvalidArgumentException(sprintf('Invalid command <$1%s>', $command::class));
        }
    }

    private function buildDisplayMessage(int $hour): string
    {
        return sprintf(
            '%1$s:00',
            str_pad(
                string: (string)$hour,
                length: 2,
                pad_string: '0',
                pad_type: STR_PAD_LEFT
            )
        );
    }
}
