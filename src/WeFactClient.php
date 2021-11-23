<?php

namespace Vdhicts\WeFact;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Vdhicts\WeFact\Contracts\RequestContract;
use Vdhicts\WeFact\Contracts\ResponseContract;

class WeFactClient
{
    private const API_URL = 'https://api.mijnwefact.nl/v2/';
    private const CONNECT_TIMEOUT = 60;
    private const TIMEOUT = 180;

    private string $apiKey;
    private Client $client;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => self::API_URL,
            'timeout' => self::TIMEOUT,
            'connect_timeout' => self::CONNECT_TIMEOUT,
            'http_errors' => false,
        ]);
    }

    private function getParams(RequestContract $request): array
    {
        return array_merge(
            [
                'api_key' => $this->apiKey,
                'controller' => $request->getController(),
                'action' => $request->getAction(),
            ],
            $request->getParams()
        );
    }

    public function perform(RequestContract $request): ResponseContract
    {
        try {
            $httpResponse = $this
                ->client
                ->request('POST', self::API_URL, ['form_params' => $this->getParams($request)]);
        } catch (GuzzleException $exception) {
            return new WeFactResponse(
                $request->getController(),
                $request->getAction(),
                ResponseContract::STATUS_ERROR,
                ['errors' => [$exception->getMessage()]]
            );
        }

        if ($httpResponse->getStatusCode() === 403) {
            return new WeFactResponse(
                $request->getController(),
                $request->getAction(),
                ResponseContract::STATUS_ERROR,
                ['errors' => [$httpResponse->getReasonPhrase()]]
            );
        }

        $data = json_decode($httpResponse->getBody(), true);

        return new WeFactResponse(
            $request->getController(),
            $request->getAction(),
            Arr::get($data, 'status', WeFactResponse::STATUS_ERROR),
            Arr::except($data, ['controller', 'action', 'status'])
        );
    }
}