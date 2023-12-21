<?php

declare(strict_types=1);

namespace App\Domain\Message;

interface PublisherBus
{
    /**
     * @param array<string, DomainEvent> $events
     */
    public function publishEvents(array $events): void;
}
