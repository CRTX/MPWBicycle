<?php

namespace App\Services;

use App\Object\BicycleTransportInterface;
use App\Object\RiderSteeringInterface;
use Exception;
use Psr\Log\LoggerInterface;

//Logging logic can become complicated at times. We can put as much logging as we need in here
class BicycleLogger implements BicycleTransportInterface
{
    public function __construct(
        private LoggerInterface $logger,
        private BicycleTransportInterface $bicycle
    ){}

    public function transport(RiderSteeringInterface $rider): void
    {
        try {
            $this->bicycle->transport($rider);
        } catch (Exception $e) {
            $userDirection = " The user's direction is currently: " . $rider->getDirection();
            $userSteering = " and steering is currently: " . $rider->getSteering();
            $this->logger->error($e->getMessage() . $userDirection . $userSteering);

            //We can either rethrow to catch the exception further up the stack or not depending on the situation.
            throw new Exception($e->getMessage());
        }
    }
}