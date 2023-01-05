<?php

namespace App\Services;

class Transistor
{
    private $parser;
    private $id;
    public function __construct(PodcastParser $parser, $option)
    {
        $this->parser = $parser;
        $this->id = $option['id'];
    }

    public function getId()
    {
        clock(66);
        return $this->id * 2;
    }
}
