<?php

namespace App\Controller;

use App\Model\LocationManager;

class AjaxController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        header('Content-Type: application/json');
    }

    public function connectApi()
    {
        $key = json_encode(API_KEY);
        return $key;
    }

    public function apiMovie()
    {
        $movie = json_encode($_SESSION['currentLocation']);
        return $movie;
    }

    public function likeLocation(int $id)
    {
        $locationManager = new LocationManager();
        $locationManager->addLike($id);
        return json_encode('Liked !');
    }

    public function dislikeLocation(int $id)
    {
        $locationManager = new LocationManager();
        $locationManager->addDislike($id);
        return json_encode('Disliked !');
    }
}
