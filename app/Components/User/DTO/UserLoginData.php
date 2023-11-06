<?php

namespace App\Components\User\DTO;

use Spatie\LaravelData\Data;

class UserLoginData extends Data
{
    public function __construct(
        public string $email,
        public string $password,
        public ?string $token_name = null,
    )
    {
    }
}
