<?php

use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, false);

$twig = Twig::create(
    'templates/',
    $settings['twig']
);
$app->add(TwigMiddleware::create($app, $twig));
