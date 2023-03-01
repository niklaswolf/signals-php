<?php

namespace Signals;

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
