<?php

namespace App\Modules\Project\DTOs;

class UpdateProjectDTO
{
    public function __construct(
        public readonly ?int    $city_id,
        public readonly ?int    $service_id,
        public readonly ?string $title,
        public readonly ?string $slug,
        public readonly ?string $description,
        public readonly ?string $location_address,
        public readonly ?bool   $is_featured,
        public readonly ?string $status,
        public readonly ?string $meta_title,
        public readonly ?string $meta_desc,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            city_id: $data['city_id'] ?? null,
            service_id: $data['service_id'] ?? null,
            title: $data['title'] ?? null,
            slug: $data['slug'] ?? null,
            description: $data['description'] ?? null,
            location_address: $data['location_address'] ?? null,
            is_featured: isset($data['is_featured']) ? (bool) $data['is_featured'] : null,
            status: $data['status'] ?? null,
            meta_title: $data['meta_title'] ?? null,
            meta_desc: $data['meta_desc'] ?? null,
        );
    }
}
