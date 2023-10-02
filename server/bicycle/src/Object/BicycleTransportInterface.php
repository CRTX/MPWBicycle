<?php

namespace App\Object;

interface BicycleTransportInterface
{
    public function transport(RiderSteeringInterface $rider): void;
}