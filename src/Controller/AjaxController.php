<?php

namespace App\Controller;

use App\Model\ArticleManager;

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
}
