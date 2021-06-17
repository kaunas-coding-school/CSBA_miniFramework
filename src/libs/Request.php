<?php

namespace CSBA\Libs;

class Request
{
    private array $payload;
    private string $path;

    public function setPayload(array $data): void
    {
        $this->payload = $data;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
