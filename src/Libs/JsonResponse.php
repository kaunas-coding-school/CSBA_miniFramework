<?php

namespace CSBA\Libs;

use JsonException;
use RuntimeException;

class JsonResponse extends Response
{
    /**
     * @throws JsonException
     * @throws RuntimeException
     */
    public function __toString(): string
    {
        if (!is_array($this->data)){
            throw new RuntimeException('Bad response format');
        }

        return json_encode($this->data, JSON_THROW_ON_ERROR);
    }
}
