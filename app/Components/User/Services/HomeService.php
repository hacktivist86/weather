<?php

namespace App\Components\User\Services;

use App\Components\WebClients\IpApi\IpApiData;
use App\Components\WebClients\IpApi\IpApiGateway;
use App\Components\WebClients\OpenWeatherMap\OpenWeatherMapData;
use App\Components\WebClients\OpenWeatherMap\OpenWeatherMapGateway;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HomeService
{
    public function __construct(
        private readonly IpApiGateway $ipApiGateway,
        private readonly OpenWeatherMapGateway $openWeatherMapGateway,
    )
    {
    }

    public function getWeather($ip): ?OpenWeatherMapData
    {
        try {
            /** @var IpApiData $location */
            $location = Cache::remember('location_' . $ip, 60, function () use ($ip) {
                return $this->ipApiGateway->getLocation($ip);
            });

            return Cache::remember('weather_' . $location->lon . '_' . $location->lat, 60, function () use ($location) {
                return $this->openWeatherMapGateway->getWeather($location);
            });
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
            return null;
        }

    }
}
