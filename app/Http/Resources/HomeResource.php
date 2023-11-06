<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    public function toArray($request): array
    {
        $user = auth()->user();
        return [
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'profile' => $user->profile,
                'status' => $user->status,
                'created_at' => $user->created_at->timestamp,
                'updated_at' => $user->updated_at->timestamp,
            ],
            'main' => [
                'temp' => $this->resource?->temp,
                'pressure' => $this->resource?->pressure,
                'humidity' => $this->resource?->humidity,
                'temp_min' => $this->resource?->temp_min,
                'temp_max' => $this->resource?->temp_max,
            ],
        ];
    }
}
