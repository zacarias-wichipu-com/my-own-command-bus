<?php

declare(strict_types=1);

namespace App\Handler;

use App\Command\Command;

interface CommandHandler
{
    public function __invoke(Command $command): void;
}
