<?php

namespace CSBA\Exceptions;

use Exception;

class PathNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Sorry page not found :)', 404);
    }
}
