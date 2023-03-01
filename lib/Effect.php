<?php

namespace Signals;

class Effect
{
    public static function create(callable $fn): void
    {
        $running = new Running($fn);
        $running->execute();
    }
}
