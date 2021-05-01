<?php

declare(strict_types=1);

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

require 'src/routes.php';

$app->run();
