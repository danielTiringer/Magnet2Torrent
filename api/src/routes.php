<?php

use App\Magnet\MagnetConvertAction;
use App\Magnet\MagnetIndexAction;

$app->get('/', MagnetIndexAction::class)->setName('index');
$app->post('/', MagnetConvertAction::class)->setName('convert');
