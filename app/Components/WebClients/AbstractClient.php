<?php

namespace App\Components\WebClients;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class AbstractClient
{
    protected string $baseUrl = '/';

    protected array $headers = [];

    protected bool $debug = false;

    protected int $times = 1;

    protected int $sleep = 0;

    public function setHeaders(array $headers): AbstractClient
    {
        $this->headers = $headers;
        return $this;
    }

    protected function request(string $method, string $endpoint, ?array $data = null, array $query = []): Response
    {
        $uri = $this->baseUrl . $endpoint;

        $options = [
            'headers' => $this->headers,
            'json' => $data,
            'debug' => $this->debug,
        ];

        if (! empty($query)) {
            $uri .= '?' . http_build_query($query);
        }

        return Http::retry($this->times, $this->sleep)->send($method, $uri, $options);
    }
}
