<?php

namespace App\Controller;

use App\Model\LocationManager;

class LocationController extends AbstractController
{
    public function questionsPage(): string
    {
        $location = $this->show();
        $goodAnswerIndex = rand(0, 3);
        $proposals = $this->showProposals($location['movie_tag'], $location['movie_name'], $goodAnswerIndex);

        return $this->twig->render('Location/show.html.twig', [
            'location' => $location,
            'proposals' => $proposals,
        ]);
    }

    public function show(): array
    {
        $locationManager = new LocationManager();
        $location = $locationManager->selectRandomLocation();
        return $location;
    }

    public function showProposals(string $answerTag, string $answerName, int $goodAnswerIndex): array
    {
        $locationManager = new LocationManager();
        $falseAnswers = $locationManager->selectFalseproposals($answerTag);
        $proposals = [];
        foreach ($falseAnswers as $falseAnswer) {
            array_push($proposals, $falseAnswer['movie_name']);
        }
        array_splice($proposals, $goodAnswerIndex, 0, $answerName);
        return $proposals;
    }

    public function addLocation(): string|null
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);

            $errors = [];

            if (!isset($data['movieName']) || empty($data['movieName'])) {
                $errors[] = "The movie name is needed";
            }
            if (strlen($data['movieName']) > 255) {
                $errors[] = 'The movie name must be less than 255 characters';
            }
            if (!isset($data['movieTag']) || empty($data['movieTag'])) {
                $errors[] = "The movie tag is needed";
            }
            if (strlen($data['movieTag']) > 100) {
                $errors[] = 'The movie tag must be less than 100 characters';
            }
            if (!isset($data['url']) || empty($data['url'])) {
                $errors[] = "The url is needed";
            }
            if (strlen($data['url']) > 1000) {
                $errors[] = 'The url must be less than 100 characters';
            }
            if (!empty($data['url']) && !filter_var($data['url'], FILTER_VALIDATE_URL)) {
                $errors[] = 'The URL is not valid';
            }

            if (!empty($errors)) {
                return $this->twig->render('Location/addLocation.html.twig', ['errors' => $errors]);
            } else {
                $locationManager = new LocationManager();
                $locationManager->insert($data);
                $thanks = "Thank you for your contribution";
                return $this->twig->render('Location/addLocation.html.twig', ['thanks' => $thanks]);
            }
        }

        return $this->twig->render('Location/addLocation.html.twig');
    }
}
