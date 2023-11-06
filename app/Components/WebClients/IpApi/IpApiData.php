<?php

namespace App\Components\WebClients\IpApi;

use Spatie\LaravelData\Data;

class IpApiData extends Data
{
    public function __construct(
        public string $lat,
        public string $lon,
    )
    {
    }
}
