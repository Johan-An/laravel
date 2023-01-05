<?php

namespace App\Services;

use App\Services\Interfaces\ComputerInterface;

class Computer implements ComputerInterface
{
    protected $price;
    protected $name;
    protected $discount;

    public function __construct(Screen $screen, $discount = 1)
    {
        $this->screen    = $screen;
        $this->price     = 1000;
        $this->discount  = $discount;
    }

    public function getPrice()
    {
        return ($this->price + $this->screen->price) * $this->discount;
    }
}
