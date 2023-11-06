<?php

namespace App\Components\WebClients\OpenWeatherMap;

use Spatie\LaravelData\Data;

class OpenWeatherMapData extends Data
{
    public function __construct(
        public float $temp,
        public float $pressure,
        public float $humidity,
        public ?float $temp_min = null,
        public ?float $temp_max = null,
    )
    {
    }
}
