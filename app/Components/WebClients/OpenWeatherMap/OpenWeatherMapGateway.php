<?php

namespace App\Components\WebClients\OpenWeatherMap;

use App\Components\WebClients\IpApi\IpApiData;
use Illuminate\Support\Arr;

class OpenWeatherMapGateway
{
    public function __construct(private readonly OpenWeatherMapClient $openWeatherMapClient)
    {
    }

    public function getWeather(IpApiData $ipApiData): OpenWeatherMapData
    {
        $params = [
            'lon' => $ipApiData->lon,
            'lat' => $ipApiData->lat,
            'units' => 'metric',
            'appid' => config('services.open_weather_map.api_key'),
        ];

        $response = $this->openWeatherMapClient->getWeatherByLocation($params)->json();

        if (200 === Arr::get($response, 'cod')) {
            return OpenWeatherMapData::from(Arr::get($response, 'main'));
        }
        throw new \Exception('OpenWeatherMap response error');
    }
}
