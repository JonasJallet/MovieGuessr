<?php

namespace App\Controller;

use App\Model\LocationManager;

class LocationController extends AbstractController
{
    public function index(): string
    {
        $locationManager = new LocationManager();
        $locations = $locationManager->selectAll('title');

        return $this->twig->render('Location/index.html.twig', ['locations' => $locations]);
    }

    public function show(int $id): string
    {
        $locationManager = new LocationManager();
        $location = $locationManager->selectOneById($id);

        return $this->twig->render('Location/show.html.twig', ['location' => $location]);
    }

    public function edit(int $id): ?string
    {
        $locationManager = new LocationManager();
        $location = $locationManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $location = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $locationManager->update($location);

            header('Location: /location/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('Location/edit.html.twig', [
            'location' => $location,
        ]);
    }

    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $location = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $locationManager = new LocationManager();
            $id = $locationManager->insert($location);

            header('Location:/locations/show?id=' . $id);
            return null;
        }

        return $this->twig->render('Location/add.html.twig');
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $locationManager = new LocationManager();
            $locationManager->delete((int)$id);

            header('Location:/guess');
        }
    }
}
