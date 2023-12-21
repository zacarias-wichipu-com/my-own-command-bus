<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Application\DomainEventHandler;
use App\Domain\Event\DomainEvent;
use App\Infrastructure\Middleware\Middleware;


final readonly class DomainEventBus
{
    public function __construct(
        private DomainEventHandlerDriver $eventHandlerDriver,
        private Middleware $middleware
    ) {
    }

    /**
     * @param array<string, DomainEventHandler> $events
     */
    public function __invoke(array $events): void
    {
        array_walk(
            array: $events,
            callback: fn(DomainEvent $event) => $this->publish($event)
        );
    }

    public function publish(DomainEvent $event): void
    {
        ($this->middleware)($event, $this);
    }

    public function handle(DomainEvent $event): void
    {
        $handlers = $this->eventHandlerDriver->getDomainEventHandlersFor(domainEvent: $event);
        if (empty($handlers)) {
            return;
        }
        foreach ($handlers as $handler) {
            ($handler)(command: $event);
        }
    }
}
