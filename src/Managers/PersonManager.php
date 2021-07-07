<?php

namespace CSBA\Managers;

use CSBA\Repositories\PersonRepository;

class PersonManager extends BaseManager
{
    public function __construct()
    {
        $this->repository = new PersonRepository();
    }
}
