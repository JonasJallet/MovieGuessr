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

    public function update(array $location): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $location['id'], PDO::PARAM_INT);
        $statement->bindValue('movie_name', $location['movie_name'], PDO::PARAM_STR);
        $statement->bindValue('scene_name', $location['scene_name'], PDO::PARAM_STR);
        $statement->bindValue('url', $location['url'], PDO::PARAM_STR);
        return $statement->execute();
    }

    public function selectRandomLocation(): array
    {
        $query = 'SELECT * FROM ' . static::TABLE . ' ORDER BY RAND() LIMIT 1';
        return $this->pdo->query($query)->fetch();
    }

    public function selectFalseproposals(string $answerTag): array
    {
        $query = "SELECT DISTINCT(movie_name) FROM location WHERE movie_tag != '" . $answerTag . "'
        ORDER BY RAND() LIMIT 3";
        return $this->pdo->query($query)->fetchAll();
    }
}
