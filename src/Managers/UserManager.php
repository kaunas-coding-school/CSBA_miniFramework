<?php

namespace CSBA\Managers;

use CSBA\Repositories\UserRepository;

class UserManager extends BaseManager
{
    public function __construct()
    {
        $this->repository = new UserRepository();
    }
}
