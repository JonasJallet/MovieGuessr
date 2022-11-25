<?php

namespace App\Controller;

use App\Model\LocationManager;
use App\Service\Verification;

class LocationController extends AbstractController
{
    protected array $location;
    protected array $proposals;

    // PAGE QUESTIONS
    public function questionsPage(): string
    {
        $locationChosen = $this->show();
        if ($locationChosen == false) {
            session_unset();
            $locationChosen = $this->show();
        }
        $this->location = $locationChosen;
        $_SESSION['currentLocation'] = $this->location;
        $_SESSION['locationPlayed'][] = $this->location['id'];

        $this->proposals = $this->showProposals($this->location);

        return $this->twig->render('Location/show.html.twig', [
            'location' => $this->location,
            'proposals' => $this->proposals,
        ]);
    }

    public function show(): array|false
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

    // PAGE FORM
    public function addLocation(): string|null
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $verification = new Verification();
            $errors = $verification->verification($data);

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

    // PAGE RESULT
    public function resultPage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['answer'])) {
            $this->checkAnswers($_SESSION['currentLocation']['movie_tag']);
        }
        return $this->twig->render('Location/result.html.twig', [
            'location' => $_SESSION['currentLocation'],
            'correctAnswer' => $_SESSION['correctAnswer']
        ]);
    }

    public function checkAnswers(string $answer): void
    {
        if ($_POST['answer'] == $answer) {
            $_SESSION['correctAnswer'] = true;
        } else {
            $_SESSION['correctAnswer'] = false;
        }
    }
}
