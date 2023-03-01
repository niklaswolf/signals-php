<?php

namespace Signals;

class Effect
{
    public function __construct(callable $fn)
    {
        $running = new Running($fn);
        $running->execute();
    }

    public static function create(callable $fn): void
    {
        new static($fn);
    }
}
