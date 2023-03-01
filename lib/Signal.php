<?php

namespace Signals;

use ArrayObject;

class Signal
{
    private ArrayObject $subscriptions;

    public function __construct(private mixed $value = null)
    {
        $this->subscriptions = new ArrayObject();
    }

    public function read()
    {
        $context = Context::getInstance();
        $running = $context->getLastItem();
        if ($running) {
            $this->subscribe($running);
        }
        return $this->value;
    }

    public function write(mixed $nextValue): void
    {
        $this->value = $nextValue;
        foreach ($this->subscriptions as $subscription) {
            /** @var Running $subscription */
            $subscription->execute();
        }
    }

    private function subscribe(Running $running): void
    {
        $this->subscriptions[] = $running;
        $running->addDependency($this->subscriptions);
    }
}
