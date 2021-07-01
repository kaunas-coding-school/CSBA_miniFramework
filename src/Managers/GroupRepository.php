<?php

namespace CSBA\Managers;

use PDO;

class GroupRepository
{
    private function getDbConnection(): PDO
    {
        $servername = 'db';
        $username = 'devuser';
        $password = 'devpass';
        $dbName = 'csba_db';
        $port = 3306;

        $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }

    public function getAll(): array
    {
        $conn = $this->getDbConnection();
        $sqlString = "SELECT id, title FROM gruops";
        $stmt = $conn->query($sqlString);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): array
    {
        $conn = $this->getDbConnection();
        $sqlString = "SELECT * FROM gruops WHERE id = :id";
        $stmt = $conn->prepare($sqlString);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): int
    {
        $conn = $this->getDbConnection();
        $sqlString = "INSERT INTO gruops SET title = :title, address_id = :address_id, state = :state";
        $stmt = $conn->prepare($sqlString);
        $stmt->bindValue(':title', $data['title']);
        $stmt->bindValue(':address_id', $data['address_id']);
        $stmt->bindValue(':state', $data['state']);
        $stmt->execute();

        return $conn->lastInsertId();
    }

    public function update(array $data): array
    {
        $conn = $this->getDbConnection();
        $sqlString = "UPDATE gruops SET title = :title, address_id = :address_id, state = :state WHERE id = :id";
        $stmt = $conn->prepare($sqlString);
        $stmt->bindValue(':title', $data['title']);
        $stmt->bindValue(':address_id', $data['address_id']);
        $stmt->bindValue(':state', $data['state']);
        $stmt->bindValue(':id', $data['id']);
        $stmt->execute();

        return $this->findById($data['id']);
    }

    public function deleteById(mixed $id): void
    {
        $conn = $this->getDbConnection();
        $sqlString = "DELETE FROM gruops WHERE id = :id";
        $stmt = $conn->prepare($sqlString);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}
