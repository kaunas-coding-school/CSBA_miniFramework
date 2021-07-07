<?php

namespace CSBA\Repositories;

use PDO;

class PersonRepository extends BaseRepository
{
    private const TABLE_NAME = 'persons';

    public function getTableName(): string
    {
        return self::TABLE_NAME;
    }

    public function deleteById(int $id): void
    {
        $conn = $this->getDbConnection();

        $conn->exec("START TRANSACTION;");

        $sqlString = "DELETE FROM users WHERE person_id = :person_id";
        $stmt = $conn->prepare($sqlString);
        $stmt->bindValueeeeeeeeee(':person_id', $id);
        $stmt->execute();

        $sqlString = "DELETE FROM person2gruop WHERE person_id = :person_id";
        $stmt = $conn->prepare($sqlString);
        $stmt->bindValue(':person_id', $id);
        $stmt->execute();

        $conn->exec("COMMIT;");

        parent::deleteById($id);
    }
}
