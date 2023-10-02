<?php

namespace App\Object;

interface RiderSteeringInterface
{
    public function getSteering(): string;
    public function getDirection(): string;
}