<?php

namespace Signals;
require_once 'Running.php';

class Effect
{
    public static function create(callable $fn): void
    {
        $running = new Running($fn);
        $running->execute();
    }
}
