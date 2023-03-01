<?php

namespace Signals;

class Context
{

    private array $context = [];
    private static ?Context $instance = null;

    public function __construct()
    {
    }

    public function __clone(): void
    {

    }

    public static function getInstance(): Context
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    public function getLastItem(): ?Running
    {
        return $this->context[count($this->context) - 1];
    }

    public function addItem(Running $item): void
    {
        $this->context[] = $item;
    }

    public function removeLastItem(): void
    {
        array_pop($this->context);
    }

}
