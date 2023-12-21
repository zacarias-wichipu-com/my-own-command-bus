<?php

declare(strict_types=1);

namespace App\Domain\Message;

interface HandlerBus
{
    public function handle(Command $message): void;
}
