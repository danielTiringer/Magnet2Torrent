<?php

namespace App\Magnet;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class MagnetIndex
{
    public function __invoke(Request $request, Response $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'magnet/index.html.twig');
    }
}
