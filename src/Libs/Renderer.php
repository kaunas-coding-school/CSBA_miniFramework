<?php

namespace CSBA\Libs;

use JsonException;
use RuntimeException;

class Renderer
{
    /**
     * @throws JsonException
     * @throws RuntimeException
     */
    public function render(ResponseInterface $response): void
    {
        $data = $response->data;

        if ($response instanceof JsonResponse) {
            $data = $response->__toString();
        }

        if ($data instanceof \Iterator || is_array($data)) {
            $this->arrayRender($data);
        } elseif ($data instanceof \Stringable || is_string($data)){
            echo $data;
        } else {
            throw new RuntimeException('Unknown response type');
        }
    }

    /**
     * @param  mixed  $data
     */
    private function arrayRender(array|\Iterator $data): void
    {
        foreach ($data as $key => $item) {
            echo $key . ' = ' . $item . '<\br>';
        }
    }
}
