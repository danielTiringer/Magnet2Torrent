<?php

$settings = [];

$settings['twig'] = [
    'cache' => false,
];

if ($ENV = 'prod') {
    $settings['error']['display_error_details'] = false;
}

return $settings;
