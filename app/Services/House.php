<?php

namespace App\Services;

use App\Services\Interfaces\HouseInterface;

class House implements HouseInterface
{
    public $light;
    public $member;

    public function __construct(Light $light, $member)
    {
        $this->light = $light;
        $this->member = $member;
    }

    public function turnOnLight()
    {
        $this->light->turnOn();
        return $this;
    }
}
