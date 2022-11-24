<?php

namespace App\Model;

use PDO;

class LocationManager extends AbstractManager
{
    public const TABLE = 'location';

    public function insert(array $location): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`movie_name`, `scene_name`, `url`) 
        VALUES (:movie_name, :scene_name, url)");
        $statement->bindValue('movie_name', $location['movie_name'], PDO::PARAM_STR);
        $statement->bindValue('scene_name', $location['scene_name'], PDO::PARAM_STR);
        $statement->bindValue('url', $location['url'], PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
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

    public function selectRandomLocation(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE . ' ORDER RAND() LIMIT 1';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }
}
