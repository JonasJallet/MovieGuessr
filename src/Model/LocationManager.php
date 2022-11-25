<?php

namespace App\Model;

use PDO;

class LocationManager extends AbstractManager
{
    public const TABLE = 'location';

    public function insert(array $location): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`movie_name`, `movie_tag`, `url`) 
        VALUES (:movie_name, :movie_tag, :url)");
        $statement->bindValue(':movie_name', $location['movieName'], PDO::PARAM_STR);
        $statement->bindValue(':movie_tag', $location['movieTag'], PDO::PARAM_STR);
        $statement->bindValue(':url', $location['url'], PDO::PARAM_STR);
        $statement->execute();
    }

    public function selectRandomLocation(): array|false
    {
        $query = 'SELECT * FROM location';
        if (isset($_SESSION['locationPlayed'])) {
            $query .= ' WHERE id NOT IN (' . implode(", ", $_SESSION['locationPlayed']) . ')';
        }
        $query .= ' ORDER BY RAND() LIMIT 1;';
        return $this->pdo->query($query)->fetch();
    }

    public function selectFalseproposals(string $answerTag): array
    {
        $query = "SELECT DISTINCT(movie_name), movie_tag FROM location WHERE movie_tag != '" . $answerTag . "'
        ORDER BY RAND() LIMIT 3";
        return $this->pdo->query($query)->fetchAll();
    }
}
