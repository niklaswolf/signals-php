<?php

namespace Signals;
require_once 'Signal.php';
require_once 'Effect.php';

class Memo
{
    public static function create(callable $fn): mixed
    {
        $signal = new Signal();
        Effect::create(function() use ($signal, $fn){
            $signal->write($fn());
        });
        return $signal;
    }
}
