<?php

namespace CSBA\Controllers;

use CSBA\Libs\Request;
use http\Env\Response;

class TestController
{
    public function bandymas(Request $request)
    {
        return implode(',', $request->getPayload());
    }

    public function bandymas2(Request $request)
    {
        $fileContent = file_get_contents(__DIR__ . '/../../Resources/Templates/index.html');

        return str_replace(['{{KEY}}', '{{VALUE}}'], $request->getPayload(), $fileContent);
    }
}
