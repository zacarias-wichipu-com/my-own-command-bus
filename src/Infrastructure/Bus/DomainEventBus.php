<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Domain\Message\Command;
use App\Domain\Message\DomainEvent;
use App\Domain\Message\PublisherBus;
use App\Infrastructure\Middleware\Middleware;


final readonly class DomainEventBus implements PublisherBus
{
    public function __construct(
        private DomainEventHandlerDriver $eventHandlerDriver,
        private Middleware $middlewares
    ) {
    }

    /**
     * @param array<string, DomainEvent> $events
     */
    public function __invoke(array $events): void
    {
        array_walk(
            array: $events,
            callback: fn(DomainEvent $event) => $this->publish($event)
        );
    }

    /**
     * @param array<string, DomainEvent> $events
     */
    public function publishEvents(array $events): void
    {
        array_walk(
            array: $events,
            callback: fn(DomainEvent $event) => $this->publish($event)
        );
    }

    private function publish(DomainEvent $event): void
    {
        ($this->middlewares)($event, $this);
    }

    public function handle(Command|DomainEvent $message): void
    {
        $handlers = $this->eventHandlerDriver->getDomainEventHandlersFor(domainEvent: $message);
        if (empty($handlers)) {
            return;
        }
        foreach ($handlers as $handler) {
            ($handler)(domainEvent: $message);
        }
    }
}
