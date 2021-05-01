<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;

// Make all filepaths relative to root
chdir(dirname(__DIR__));

require 'vendor/autoload.php';

$settings = require 'config/settings.php';

$app = AppFactory::create();

require 'src/middlewares.php';

require 'src/routes.php';

$app->run();
