<?php

namespace App\Modules\Project\Services;

use App\Models\Project;
use App\Modules\Project\DTOs\CreateProjectDTO;
use App\Modules\Project\DTOs\UpdateProjectDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{

    public function listPublic(array $filters = []): LengthAwarePaginator
    {
        $query = Project::with(['city', 'service', 'media'])
            ->where('status', 'active');

        if (! empty($filters['city'])) {
            $query->whereHas('city', fn($q) => $q->where('slug', $filters['city']));
        }

        if (! empty($filters['service'])) {
            $query->whereHas('service', fn($q) => $q->where('slug', $filters['service']));
        }

        return $query->latest()->paginate(12);
    }


    public function findBySlug(string $slug): Project
    {
        return Project::with(['city', 'service', 'media', 'reviews'])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();
    }


    public function featured(): Collection
    {
        return Project::with(['city', 'service', 'media'])
            ->where('status', 'active')
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();
    }


    public function adminList(array $filters = []): LengthAwarePaginator
    {
        $query = Project::with(['city', 'service']);

        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (! empty($filters['city'])) {
            $query->whereHas('city', fn($q) => $q->where('slug', $filters['city']));
        }

        if (! empty($filters['service'])) {
            $query->whereHas('service', fn($q) => $q->where('slug', $filters['service']));
        }

        return $query->latest()->paginate(15);
    }


    public function findById(int $id): Project
    {
        return Project::with(['city', 'service', 'media', 'reviews'])->findOrFail($id);
    }


    public function create(CreateProjectDTO $dto): Project
    {
        return Project::create([
            'city_id'          => $dto->city_id,
            'service_id'       => $dto->service_id,
            'title'            => $dto->title,
            'slug'             => $dto->slug,
            'description'      => $dto->description,
            'location_address' => $dto->location_address,
            'is_featured'      => $dto->is_featured,
            'status'           => $dto->status,
            'meta_title'       => $dto->meta_title,
            'meta_desc'        => $dto->meta_desc,
        ]);
    }


    public function update(int $id, UpdateProjectDTO $dto): Project
    {
        $project = Project::findOrFail($id);

        $project->update(array_filter([
            'city_id'          => $dto->city_id,
            'service_id'       => $dto->service_id,
            'title'            => $dto->title,
            'slug'             => $dto->slug,
            'description'      => $dto->description,
            'location_address' => $dto->location_address,
            'is_featured'      => $dto->is_featured,
            'status'           => $dto->status,
            'meta_title'       => $dto->meta_title,
            'meta_desc'        => $dto->meta_desc,
        ], fn($value) => ! is_null($value)));

        return $project->fresh(['city', 'service']);
    }


    public function delete(int $id): void
    {
        Project::findOrFail($id)->delete();
    }
}
