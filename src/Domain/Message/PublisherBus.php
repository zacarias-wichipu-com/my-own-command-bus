<?php

declare(strict_types=1);

namespace App\Domain\Message;

interface PublisherBus
{
    /**
     * @param array<string, DomainEvent> $domainEvents
     */
    public function publishEvents(array $domainEvents): void;
}
