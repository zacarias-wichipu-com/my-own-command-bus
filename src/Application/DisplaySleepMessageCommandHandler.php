<?php

declare(strict_types=1);

namespace App\Application;

use App\ClockDisplay;
use App\DisplayMessage;
use App\Domain\Bus\Command\CommandHandler;

use function str_pad;

final readonly class DisplaySleepMessageCommandHandler implements CommandHandler
{
    private ClockDisplay $clockDisplay;

    public function __construct(
        private DisplayMessage $message
    ) {
        $this->clockDisplay = new ClockDisplay();
    }

    public function __invoke(DisplaySleepMessageCommand $command): void
    {
        $this->clockDisplay->update(
            message: $this->buildDisplayMessage($command->hour())
        );
    }

    private function buildDisplayMessage(int $hour): string
    {
        return sprintf(
            '%1$s:00 <%2$s>',
            str_pad(
                string: (string)$hour,
                length: 2,
                pad_string: '0',
                pad_type: STR_PAD_LEFT
            ),
            $this->message->goodNight()
        );
    }
}
