<?php

namespace App\Magnet;

use App\Http\WebmasterApiClient;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Slim\Views\Twig;

class MagnetConvertAction
{
    public function __invoke(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();

        $httpClient = new Client();
        $apiClient = new WebmasterApiClient($httpClient);
        $apiResponse = $apiClient->fetchTorrentLink($data['magnet']);

        $view = Twig::fromRequest($request);

        if ($apiResponse['code'] === 1) {
            return $view->render(
                $response,
                'magnet/download.html.twig',
                [
                    'torrent_url' => $apiResponse['results'],
                ]
            );
        } else {
            return $view->render(
                $response,
                'magnet/error.html.twig',
                [
                    'error' => $apiResponse['error'],
                ]
            );
        }
    }
}
