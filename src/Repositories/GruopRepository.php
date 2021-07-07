<?php

namespace CSBA\Repositories;

use PDO;

class GruopRepository extends BaseRepository
{
    const TABLE_NAME = 'gruops';

    function getTableName(): string
    {
        return self::TABLE_NAME;
    }
}
