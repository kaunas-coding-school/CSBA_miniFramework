<?php

namespace CSBA\Libs;

use CSBA\Exceptions\PathNotFoundException;
use CSBA\Libs\Request;
use CSBA\Libs\Response;

class Router
{
    private Request $request;
    private array $map;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function addRoute(string $path, array $controllerAction): void
    {
        $this->map[$path] = [
            'controller' => $controllerAction[0],
            'method'     => $controllerAction[1],
        ];
    }

    /**
     * @throws PathNotFoundException
     */
    public function init(): void
    {
        $path = $this->request->getPath();
        if (!array_key_exists($path, $this->map)) {
            throw new PathNotFoundException();
        }

        $controllerClass = $this->map[$path]['controller'];
        $controllerMethod = $this->map[$path]['method'];

        /*  @var Response $response */
        $response = (new $controllerClass())->$controllerMethod($this->request);
        $renderer = new Renderer();
        $renderer->render($response);
    }
}
