<?php

namespace App\Components\WebClients\IpApi;

use App\Components\WebClients\AbstractClient;
use Illuminate\Http\Client\Response;

class IpApiClient extends AbstractClient
{
    public function __construct()
    {
        $this->baseUrl = config('services.ip_api.domain');
    }

    public function getLocationByIp(string $ip): Response
    {
        return $this->request('GET', '/json/' . $ip);
    }
}
