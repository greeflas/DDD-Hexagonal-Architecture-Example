<?php

declare(strict_types=1);

namespace App;

trait EventTrait
{
    protected $events = [];

    public function recordEvent($event): void
    {
        $this->events[] = $event;
    }

    public function releaseEvents(): iterable
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }
}
