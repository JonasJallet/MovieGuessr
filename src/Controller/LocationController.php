<?php

namespace App\Controller;

use App\Model\LocationManager;

class LocationController extends AbstractController
{
    public function show(): string
    {
        $locationManager = new LocationManager();
        $locations = $locationManager->selectRandomLocation();

        return $this->twig->render('Location/show.html.twig', ['locations' => $locations]);
    }
}
