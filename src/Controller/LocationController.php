<?php

namespace App\Controller;

use App\Model\LocationManager;

class LocationController extends AbstractController
{
    public function show(): string
    {
        $locationManager = new LocationManager();
        $location = $locationManager->selectRandomLocation();

        return $this->twig->render('Location/show.html.twig', ['location' => $location]);
    }
}
