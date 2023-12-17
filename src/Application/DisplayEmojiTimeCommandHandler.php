<?php

declare(strict_types=1);

namespace App\Application;

use App\ClockDisplay;
use App\Domain\Bus\Command\CommandHandler;

final readonly class DisplayEmojiTimeCommandHandler implements CommandHandler
{
    private const array EMOJIS = [
        '🕛',
        '🕐',
        '🕑',
        '🕒',
        '🕓',
        '🕔',
        '🕕',
        '🕖',
        '🕗',
        '🕘',
        '🕙',
        '🕚',
    ];
    private ClockDisplay $clockDisplay;

    public function __construct()
    {
        $this->clockDisplay = new ClockDisplay();
    }

    public function __invoke(DisplayTimeCommand $command): void
    {
        $this->clockDisplay->update(
            message: $this->buildDisplayMessage($command->hour())
        );
    }

    private function buildDisplayMessage(int $hour): string
    {
        return sprintf(
            '%1$s',
            self::EMOJIS[$hour % 12]
        );
    }
}
