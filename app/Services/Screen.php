<?php

namespace App\Services;

class Screen
{
    public $status;

    public $price = 200;

    public function __construct()
    {
        $this->status = 'OFF';
    }

    public function up()
    {
        $this->status = 'ON';
    }

    public function down()
    {
        $this->status = 'OFF';
    }
}
