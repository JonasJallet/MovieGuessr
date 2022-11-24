<?php

namespace App\Controller;

use App\Model\LocationManager;

class LocationController extends AbstractController
{
    protected array $location;
    protected array $proposals;

    public function questionsPage(): string
    {
        $this->location = $this->show();
        $this->proposals = $this->showProposals($this->location);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['answer'])) {
            $this->checkAnswers($this->location['movie_tag']);
        }

        return $this->twig->render('Location/show.html.twig', [
            'location' => $this->location,
            'proposals' => $this->proposals,
        ]);
    }

    public function show(): array
    {
        $locationManager = new LocationManager();
        $location = $locationManager->selectRandomLocation();
        return $location;
    }

    public function showProposals(array $answer): array
    {
        $locationManager = new LocationManager();
        $falseAnswers = $locationManager->selectFalseproposals($answer['movie_tag']);
        $goodAnswerIndex = rand(0, 3);
        $proposals = [];
        foreach ($falseAnswers as $falseAnswer) {
            array_push($proposals, $falseAnswer);
        }
        array_splice($proposals, $goodAnswerIndex, 0, [$answer]);

        return $proposals;
    }

    public function checkAnswers(string $answer): void
    {
        if ($_POST['answer'] == $answer) {
            header('Location: result?id=' . $this->location['id'] . '&result=1');
        }
        header('Location: result?id=' . $this->location['id'] . '&result=2');
    }
}
