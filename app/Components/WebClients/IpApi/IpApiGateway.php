<?php

namespace App\Components\WebClients\IpApi;

use Illuminate\Support\Arr;

class IpApiGateway
{
    public function __construct(private readonly IpApiClient $ipApiClient)
    {
    }

    public function getLocation(string $ip): IpApiData
    {
        $response = $this->ipApiClient->getLocationByIp($ip)->json();

        if ('success' === Arr::get($response, 'status')) {
            return IpApiData::from($response);
        }
        throw new \Exception('IpApi response error');
    }
}
