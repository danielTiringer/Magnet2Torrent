<?php

namespace Tests\Unit\Http;

use App\Http\WebmasterApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class WebmasterApiClientTest extends TestCase
{
    /**
     * Tests the behavior of the fetchTorrentLink function
     *
     * @param string $returnJSON
     * @param array  $expectedResult
     *
     * @dataProvider fetchTorrentLinkDataProvider
     *
     * @return void
     */
    public function testFetchTorrentLink($returnJSON, $expectedResult)
    {
        $mockResponse = $this->createMock(Response::class);
        $mockResponse
            ->method('getBody')
            ->willReturn($returnJSON);

        $httpClient = $this->createMock(Client::class);
        $httpClient
            ->method('get')
            ->with('https://api.webmasterapi.com/v1/magnet2torrent/fakeApiKey/12345')
            ->willReturn($mockResponse);

        $SUT = new WebmasterApiClient($httpClient);
        $this->assertEquals($expectedResult, $SUT->fetchTorrentLink('12345'));
    }

    public function fetchTorrentLinkDataProvider(): array
    {
        return [
            'success case' => [
                '{"code":1,"results":"https://s1.webmasterapi.com/torrent-12345-67890.torrent"}',
                [
                    'code' => 1,
                    'results' => 'https://s1.webmasterapi.com/torrent-12345-67890.torrent',
                ],
            ],
            'failure case' => [
                '{"code":0,"error":"Magnet is incorrect!"}',
                [
                    'code' => 0,
                    'error' => 'Magnet is incorrect!',
                ],
            ]
        ];
    }
}
