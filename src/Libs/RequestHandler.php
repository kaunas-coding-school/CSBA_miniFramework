<?php

namespace CSBA\Libs;

use CSBA\Libs\Request;

class RequestHandler
{
    private Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->handleRequest();
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    private function handleRequest(): void
    {
        $this->resolvePayload();
        $this->resolvePath();
    }

    private function resolvePayload(): void
    {
        $jsonRequestPayload = file_get_contents('php://input');

        if (empty($jsonRequestPayload)) {
            $jsonRequestPayload = $_POST ?? [];
        } else {
            $jsonRequestPayload = json_decode($jsonRequestPayload, true, 512, JSON_THROW_ON_ERROR);
        }

        $requestPayload = array_merge($_GET, $jsonRequestPayload);

        $this->request->setPayload($requestPayload);
    }

    private function resolvePath(): void
    {
        $url = $this->getFullUrl();
        $this->request->setPath(parse_url($url, PHP_URL_PATH));
    }

    private function getFullUrl(): string
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
            . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
}
