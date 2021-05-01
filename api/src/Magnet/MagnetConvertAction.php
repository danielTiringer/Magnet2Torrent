<?php

namespace App\Magnet;

use App\Http\WebmasterApiClient;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Respect\Validation\Exceptions\ValidatorException;
use Respect\Validation\Validator;
use Slim\Views\Twig;

class MagnetConvertAction
{
    public function __invoke(Request $request, Response $response, $args)
    {
        $view = Twig::fromRequest($request);

        $data = $request->getParsedBody();

        $validator = new Validator();
        $validator->addRule(
            Validator::key(
                'magnet',
                Validator::startsWith('magnet:?xt=urn:btih:')->setTemplate('The magnet\'s format is incorrect')
            )->setTemplate('The magnet link is required')
        );

        try {
            $validator->assert($data);
        } catch (ValidatorException $e) {
            return $view->render(
                $response,
                'magnet/index.html.twig',
                [
                    'errors' => $e->getMessages(),
                ]
            );
        }

        $httpClient = new Client();
        $apiClient = new WebmasterApiClient($httpClient);
        $apiResponse = $apiClient->fetchTorrentLink($data['magnet']);


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
