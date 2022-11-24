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
        $locations = $locationManager->selectRandomLocation();

        return $this->twig->render('Location/show.html.twig', ['locations' => $locations]);
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
}
