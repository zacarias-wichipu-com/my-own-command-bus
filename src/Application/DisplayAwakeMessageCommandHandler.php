<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Component\ClockDisplay;
use App\Domain\Internationalisation\DisplayMessage;
use App\Domain\Message\CommandHandler;

use function str_pad;

final readonly class DisplayAwakeMessageCommandHandler implements CommandHandler
{
    private ClockDisplay $clockDisplay;

    public function __construct(
        private DisplayMessage $message
    ) {
        $this->clockDisplay = new ClockDisplay();
    }

    public function __invoke(DisplayAwakeMessageCommand $command): void
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
            $this->message->goodMorning()
        );
    }
}
