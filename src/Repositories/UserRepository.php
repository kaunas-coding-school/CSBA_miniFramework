<?php

namespace CSBA\Repositories;

class UserRepository extends BaseRepository
{
    const TABLE_NAME = 'users';

    function getTableName(): string
    {
        return self::TABLE_NAME;
    }
}
