<?php

namespace App\Modules\Auth\DTOs;

class ChangePasswordDTO
{
    public function __construct(
        public readonly ?string $current_password,
        public readonly ?string $password,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            current_password: $data['current_password'] ?? null,
            password: $data['password'] ?? null,
        );
    }
}
