<?php

use App\Magnet\MagnetIndex;

$app->get('/', MagnetIndex::class)->setName('index');
