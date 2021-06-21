<?php

namespace CSBA\Controllers;

use CSBA\Libs\JsonResponse;
use CSBA\Libs\Request;
use CSBA\Libs\ResponseInterface;

class TestController
{
    public function bandymas(Request $request)
    {
        return implode(',', $request->getPayload());
    }

    public function bandymas2(Request $request): ResponseInterface
    {
        return new JsonResponse($request->toArray());
    }
}
