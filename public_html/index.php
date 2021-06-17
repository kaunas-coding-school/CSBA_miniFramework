<?php

require __DIR__.'/../vendor/autoload.php';

use CSBA\Controllers\TestController;
use CSBA\Libs\RequestHandler;
use CSBA\Libs\Router;

$requestHandler = new RequestHandler();

$router = new Router($requestHandler->getRequest());

$router->addRoute('/test/bandymas', [TestController::class, 'bandymas']);
$router->addRoute('/test/bandymas2', [TestController::class, 'bandymas2']);

$router->init();
