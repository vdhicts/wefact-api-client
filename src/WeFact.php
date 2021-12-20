<?php

namespace Vdhicts\WeFact;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Vdhicts\WeFact\Contracts\RequestContract;

class WeFact extends Factory
{
    private const API_URL = 'https://api.mijnwefact.nl/v2/';
    private const TIMEOUT = 180;
    private const VERSION = '2.0.0';
    private const USER_AGENT = 'vdhicts-wefact-api-client/' . self::VERSION;

    private string $apiKey;

    public function __construct(string $apiKey)
    {
        parent::__construct();

        $this->apiKey = $apiKey;
    }

    public function request(RequestContract $request): Response
    {
        return $this
            ->post(self::API_URL, array_merge(
                ['api_key' => $this->apiKey],
                $request->getRequestData()
            ));
    }

    protected function newPendingRequest(): PendingRequest
    {
        return parent::newPendingRequest()
            ->acceptJson()
            ->asJson()
            ->timeout(self::TIMEOUT)
            ->withUserAgent(self::USER_AGENT);
    }
}