<?php

namespace CSBA\Libs;

class SuccessJsonResponse extends JsonResponse
{
    public function __construct(public mixed $data = [])
    {
        $id = $this->data['id'] ?? '---';
        parent::__construct(array_merge(['message' => "Prekė $id sėkmingai pridėta"], $data));
    }
}
