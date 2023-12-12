<?php

declare(strict_types=1);

namespace App;

final class ClockDisplay
{
    public function update(Command $command): void
    {
        $command->execute();
    }
}
