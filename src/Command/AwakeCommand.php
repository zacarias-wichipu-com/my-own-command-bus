<?php

declare(strict_types=1);

namespace App\Command;

use App\Command;
use App\DisplayMessage;

use function printf;
use function str_pad;

final readonly class AwakeCommand implements Command
{
    public function __construct(
        private int $hour,
        private DisplayMessage $message
    ) {
    }

    public function execute(): void
    {
        printf(
            '%1$s:00 <%2$s>' . PHP_EOL,
            str_pad(
                string: (string)$this->hour,
                length: 2,
                pad_string: '0',
                pad_type: STR_PAD_LEFT
            ),
            $this->message->goodMorning()
        );
    }
}
