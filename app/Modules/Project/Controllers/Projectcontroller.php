<?php

namespace App\Modules\Project\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Modules\Project\DTOs\CreateProjectDTO;
use App\Modules\Project\DTOs\UpdateProjectDTO;
use App\Modules\Project\Requests\CreateProjectRequest;
use App\Modules\Project\Requests\UpdateProjectRequest;
use App\Modules\Project\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectService $projectService,
    ) {}


    public function index(Request $request): JsonResponse
    {
        $projects = $this->projectService->listPublic($request->only(['city', 'service']));

        return ApiResponse::success(
            data: $projects,
            message: 'Projects retrieved successfully.',
        );
    }


    public function featured(): JsonResponse
    {
        $projects = $this->projectService->featured();

        return ApiResponse::success(
            data: $projects,
            message: 'Featured projects retrieved successfully.',
        );
    }


    public function show(string $slug): JsonResponse
    {
        $project = $this->projectService->findBySlug($slug);

        return ApiResponse::success(
            data: $project,
            message: 'Project retrieved successfully.',
        );
    }


    public function adminIndex(Request $request): JsonResponse
    {
        $projects = $this->projectService->adminList($request->only(['city', 'service', 'status']));

        return ApiResponse::success(
            data: $projects,
            message: 'Projects retrieved successfully.',
        );
    }


    public function adminShow(int $id): JsonResponse
    {
        $project = $this->projectService->findById($id);

        return ApiResponse::success(
            data: $project,
            message: 'Project retrieved successfully.',
        );
    }


    public function store(CreateProjectRequest $request): JsonResponse
    {
        $project = $this->projectService->create(
            CreateProjectDTO::fromArray($request->validated())
        );

        return ApiResponse::success(
            data: $project,
            message: 'Project created successfully.',
            code: 201,
        );
    }


    public function update(UpdateProjectRequest $request, int $id): JsonResponse
    {
        $project = $this->projectService->update(
            $id,
            UpdateProjectDTO::fromArray($request->validated())
        );

        return ApiResponse::success(
            data: $project,
            message: 'Project updated successfully.',
        );
    }


    public function destroy(int $id): JsonResponse
    {
        $this->projectService->delete($id);

        return ApiResponse::success(
            message: 'Project deleted successfully.',
        );
    }
}
