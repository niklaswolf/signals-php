<?php

namespace Signals;
require_once 'Context.php';

use ArrayObject;
use Closure;

class Running
{
    private ArrayObject $dependencies;
    private Closure $fn;

    public function __construct(callable $fn)
    {
        $this->dependencies = new ArrayObject();
        $this->fn = $fn(...);
    }

    public function addDependency(ArrayObject $subscriptions): void
    {
        $this->dependencies->append($subscriptions);
    }

    public function cleanup(): void
    {
        foreach ($this->dependencies as $dependency) {
            /** @var ArrayObject $dependency */
            $index = array_search($this, $dependency->getArrayCopy(), true);
            unset($dependency[$index]);
        }
        $this->dependencies = new ArrayObject();
    }

    public function execute(): void
    {
        $this->cleanup();
        $context = Context::getInstance();
        $context->addItem($this);

        $this->fn->call($this);
        $context->removeLastItem();
    }
}
