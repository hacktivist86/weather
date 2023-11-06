<?php

namespace App\Components\WebClients;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class AbstractClient
{
    /** @var string */
    protected string $baseUrl = '/';

    /**
     * Request headers
     * @var array $headers
     */
    protected array $headers = [];

    /**
     * Debug mode flag
     * @var bool $debug
     */
    protected bool $debug = false;

    /**
     * @var int
     */
    protected int $times = 1;

    /**
     * @var int
     */
    protected int $sleep = 0;

    /**
     * @param array $headers
     * @return AbstractClient
     */
    public function setHeaders(array $headers): AbstractClient
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array|null $data
     * @param array $query
     * @return Response
     * @throws \Exception
     */
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
