<?php

namespace App\Services;

class Light
{
    public $name;
    public $status;

    public $position;

    public function __construct(string $position)
    {
        $this->position = $position;
    }

    public function turnOn()
    {
        $this->status[$this->position] = 'ON';
    }

    public function turnOff()
    {
        $this->status[$this->position] = 'OFF';
    }
}
