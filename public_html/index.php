<?php

require __DIR__.'/../vendor/autoload.php';

use CSBA\Controllers\BasketController;
use CSBA\Controllers\GroupController;
use CSBA\Controllers\TestController;
use CSBA\Libs\RequestHandler;
use CSBA\Libs\Router;

try {
    $serverName = getenv('APACHE_SERVER_NAME');
    $log = new Monolog\Logger($serverName);
    $log->pushHandler(new Monolog\Handler\StreamHandler('../logs/errors.log', Monolog\Logger::WARNING));

    $requestHandler = new RequestHandler();

    $router = new Router($requestHandler->getRequest());

    $router->addRoute('/test/bandymas', [TestController::class, 'bandymas']);
    $router->addRoute('/test/bandymas2', [TestController::class, 'bandymas2']);
    $router->addRoute('/krepselis/deti', [BasketController::class, 'detiIKrepseli']);

    $router->addRoute('/kontaktai', [ContactsController::class, 'show']);
    $router->addRoute('/kontaktai/zinute', [ContactsController::class, 'store']);

    $router->addRoute('/grupes', [GroupController::class, 'list']);
    $router->addRoute('/grupe', [GroupController::class, 'show']);
    $router->addRoute('/grupe/kurti', [GroupController::class, 'create']);
    $router->addRoute('/grupe/redaguoti', [GroupController::class, 'update']);
    $router->addRoute('/grupe/salinti', [GroupController::class, 'delete']);

    $router->addRoute('/asmenys', [GroupController::class, 'list']);
    $router->addRoute('/asmuo', [GroupController::class, 'show']);
    $router->addRoute('/asmuo/kurti', [GroupController::class, 'create']);
    $router->addRoute('/asmuo/redaguoti', [GroupController::class, 'update']);
    $router->addRoute('/asmuo/salinti', [GroupController::class, 'delete']);

    $router->init();
} catch (\Throwable $e) {
    echo 'Oi.. nutiko klaida';
    $log->warning($e->getMessage());
}
