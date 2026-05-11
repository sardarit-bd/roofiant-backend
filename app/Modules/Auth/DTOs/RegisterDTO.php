<?php

namespace App\Modules\Auth\DTOs;

class RegisterDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        // public readonly string $secret_key,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password']
            // secret_key: $data['secret_key'],
        );
    }
}
