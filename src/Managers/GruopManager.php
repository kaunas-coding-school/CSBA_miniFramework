<?php

namespace CSBA\Managers;

use CSBA\Repositories\GruopRepository;

class GruopManager extends BaseManager
{
    public function __construct()
    {
        $this->repository = new GruopRepository();
    }
}
