<?php

namespace CSBA\Repositories;

interface RepositoryInterface
{
    function getTableName(): string;

    public function getAll();
}
