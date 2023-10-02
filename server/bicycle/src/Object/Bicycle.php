<?php

namespace App\Object;
use Exception;

class Bicycle implements BicycleTransportInterface
{
    public function transport(RiderSteeringInterface $rider): void
    {
        $this->steer($rider);
        $this->move($rider);
    }

    //Note: Any user input errors would usually be caught through Symfony validators. But let's keep it simple :)
    private function steer(RiderSteeringInterface $rider): bool
    {
        if(
            $rider->getSteering() != "right" &&
            $rider->getSteering() != "left" &&
            $rider->getSteering() != "straight"
        ) {
            throw new Exception("There are only three ways to steer a bicycle! Right, left or straight.");
        }

        return true;
    }

    private function move(RiderSteeringInterface $rider): bool
    {
        if(
            $rider->getDirection() != "forward" &&
            $rider->getDirection() != "backward"
        ) {
            throw new Exception("There are only two directions to move a bicycle! Forward and backwards.");
        }

        return true;
    }
}