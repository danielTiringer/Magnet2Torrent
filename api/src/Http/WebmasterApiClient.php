<?php

namespace App\Http;

use Psr\Http\Client\ClientInterface;

class WebmasterApiClient
{
    private const API_BASE_URL = 'https://api.webmasterapi.com/v1/magnet2torrent';

    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function fetchTorrentLink(string $magnet): array
    {
        $url = self::API_BASE_URL . '/' . getenv('API_KEY') . '/' . $magnet;

        $response = $this->httpClient->get($url);

        return json_decode($response->getBody(), true);
    }
}
