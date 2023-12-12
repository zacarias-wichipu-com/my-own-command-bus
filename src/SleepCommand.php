<?php

declare(strict_types=1);

namespace App;

use Override;

final readonly class SleepCommand implements Command
{
    public function __construct(
        private int $hour,
        private string $message
    ) {
    }

    #[Override] public function execute(): void
    {
        printf(
            '%1$s:00 <%2$s>' . PHP_EOL,
            str_pad(
                string: (string)$this->hour,
                length: 2,
                pad_string: '0',
                pad_type: STR_PAD_LEFT
            ),
            $this->message
        );
    }
}
