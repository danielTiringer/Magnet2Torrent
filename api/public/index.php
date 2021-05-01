<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

// Make all filepaths relative to root
chdir(dirname(__DIR__));

require 'vendor/autoload.php';

$settings = require 'config/settings.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true, true, false);

$twig = Twig::create(
    'templates/',
    $settings['twig']
);
$app->add(TwigMiddleware::create($app, $twig));

$app->get('/', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'magnet/index.html.twig');
})->setName('index');

$app->run();
