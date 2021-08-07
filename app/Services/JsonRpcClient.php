<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class JsonRpcClient
{
    const JSON_RPC_VERSION = '2.0';

    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Api-Key' => config('services.jsonrpc.token'),
            ],
            'base_uri' => config('services.jsonrpc.base_uri')
        ]);
    }

    private function send(string $method, array $params = []): array
    {
        $response = $this->client
            ->post('', [
                RequestOptions::JSON => [
                    'jsonrpc' => self::JSON_RPC_VERSION,
                    'id' => time(),
                    'method' => $method,
                    'params' => $params
                ]
            ])->getBody()->getContents();

        return \json_decode($response, true);
    }

    public function activityAdd($url, $date)
    {
        return $this->send('activity_add', compact('url', 'date'));
    }

    public function activityGet()
    {
        return $this->send('activity_get')['result'];
    }
}
