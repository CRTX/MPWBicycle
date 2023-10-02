<?php

namespace App\Controller;

use App\Object\Bicycle;
use App\Object\Bicyclist;
use App\Services\BicycleLogger;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedJsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Note regarding the logger:
 * 
 * Usually loggers are injected into classes that "need" them.
 * 
 * However, using composition you can turn logging on and off
 * without injecting the logger class inside the Bicycle class.
 * 
 * This also prevents from having to touch anything inside the Bicycle class and respects its single responsibility.
 * 
 * Plus, since they also use the same interface, they can be interchanged anywhere without breaking code
 * so you're able to switch between logging or no logging with ease.
 * 
 * On top of that, there won't be refactoring of class internals this way if you want to get rid of logging
 * or adding additional responsibilities that can bloat classes.
 */
class BicycleController extends AbstractController
{
    #[Route('/api/bicycle', methods: ['GET'])]
    public function index(Request $request, LoggerInterface $logger): StreamedJsonResponse 
    {
        $direction = $request->query->get('direction');
        $steering = $request->query->get('steering');

        $rider = new Bicyclist(direction: $direction, steering: $steering);
        $bicycle = new Bicycle();

        $logBicycle = new BicycleLogger(logger: $logger, bicycle: $bicycle);

        try {
            $logBicycle->transport($rider);
            $payload = [
                "success" => true,
                "message" => "You are successfully riding a bike!",
                "direction" => $rider->getDirection(),
                "steering" => $rider->getSteering()
            ];
            return new StreamedJsonResponse($payload);
        } catch (Exception $e) {
            $payload = [
                "success" => false,
                "message" => "We don't think you're using the bike quite right. Try again!",
                "direction" => $rider->getDirection(),
                "steering" => $rider->getSteering()
            ];
            return new StreamedJsonResponse($payload);
        }

    }
}