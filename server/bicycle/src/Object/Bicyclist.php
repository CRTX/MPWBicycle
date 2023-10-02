<?php

namespace App\Object;

class Bicyclist implements RiderSteeringInterface
{
    public function __construct(
        private string $steering,
        private string $direction
    ) {
        $this->steering = strtolower($this->steering);
        $this->steering = strtolower($this->steering);
    }

    public function getSteering(): string
    {
        return $this->steering;
    }

    public function getDirection(): string
    {       
        return $this->direction;
    }
}