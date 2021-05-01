<?php

use App\Magnet\MagnetConvert;
use App\Magnet\MagnetIndex;

$app->get('/', MagnetIndex::class)->setName('index');
$app->post('/', MagnetConvert::class)->setName('convert');
