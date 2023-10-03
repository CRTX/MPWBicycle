<?php

namespace App\Object;

use App\Object\Bicyclist;
use Symfony\Component\HttpFoundation\RequestStack;

class BicycleRiderFactory
{
    public function __construct(private RequestStack $request)
    {}

    public function create(): Bicyclist
    {
        $direction = $this->request->getCurrentRequest()->query->get('direction');
        $steering = $this->request->getCurrentRequest()->query->get('steering');

        return new Bicyclist(direction: $direction, steering: $steering);
    }
}