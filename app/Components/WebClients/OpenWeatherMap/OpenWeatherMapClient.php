<?php

namespace App\Components\WebClients\OpenWeatherMap;

use App\Components\WebClients\AbstractClient;
use Illuminate\Http\Client\Response;

class OpenWeatherMapClient extends AbstractClient
{
    public function __construct()
    {
        $this->baseUrl = config('services.open_weather_map.domain');
    }

    public function getWeatherByLocation(array $params): Response
    {
        return $this->request('GET', '/data/2.5/weather/', query: $params);
    }
}
