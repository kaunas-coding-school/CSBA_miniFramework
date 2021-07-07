<?php

namespace CSBA\Repositories;

use PDO;
use RuntimeException;

Abstract class BaseRepository implements RepositoryInterface
{
    protected function getDbConnection(): PDO
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
        $sqlString = "SELECT * FROM {$this->getTableName()}";
        $stmt = $conn->query($sqlString);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): array
    {
        $conn = $this->getDbConnection();
        $sqlString = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
        $stmt = $conn->prepare($sqlString);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): int
    {
        $conn = $this->getDbConnection();

        $columns = array_keys($data);
        $current = 0;
        $setString = '';

        $count = count($columns);

        foreach ($columns as $column) {
            ++$current;
            $setString .= $column . " = :" . $column;
            if ($count > $current) {
                $setString .= ',';
            }
        }

        $sqlString = "INSERT INTO {$this->getTableName()} SET $setString";

        $stmt = $conn->prepare($sqlString);

        foreach ($columns as $column) {
            $stmt->bindValue(':' . $column, $data[$column]);
        }

        $stmt->execute();

        return $conn->lastInsertId();
    }

    public function update(array $data): array
    {
        $conn = $this->getDbConnection();

        if (!array_key_exists('id', $data)) {
            throw new RuntimeException('Nerastas ID');
        }

        $columns = array_keys($data);
        $current = 0;
        $setString = '';

        $count = count($columns);

        unset($columns[array_search('id', $columns)]);

        foreach ($columns as $column) {
            ++$current;
            $setString .= $column . " = :" . $column;
            if ($count > $current) {
                $setString .= ',';
            }
        }

        $sqlString = "UPDATE {$this->getTableName()} SET $setString  WHERE id = :id";

        $stmt = $conn->prepare($sqlString);

        foreach ($columns as $column) {
            $stmt->bindValue(':' . $column, $data[$column]);
        }

        $stmt->bindValue(':id', $data['id']);
        $stmt->execute();

        return $this->findById($data['id']);
    }

    public function deleteById(int $id): void
    {
        $conn = $this->getDbConnection();
        $sqlString = "DELETE FROM {$this->getTableName()} WHERE id = :id";
        $stmt = $conn->prepare($sqlString);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}
