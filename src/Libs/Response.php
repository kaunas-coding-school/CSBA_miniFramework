<?php

namespace CSBA\Libs;

class Response implements ResponseInterface
{
    public function __construct(public mixed $data){}
}
