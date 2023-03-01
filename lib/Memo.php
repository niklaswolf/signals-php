<?php

namespace Signals;

class Memo
{
    private Signal $signal;

    public function __construct(callable $fn)
    {
        $signal = new Signal();
        $this->signal = $signal;
        Effect::create(function() use ($signal, $fn){
            $signal->write($fn());
        });
    }

    public function read(){
        return $this->signal->read();
    }

    public static function create(callable $fn): static
    {
        return new static($fn);
    }
}
