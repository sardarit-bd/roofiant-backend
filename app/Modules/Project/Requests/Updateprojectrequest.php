<?php

namespace App\Modules\Project\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends BaseRequest
{
    public function rules(): array
    {
        $projectId = $this->route('id');

        return [
            'city_id'          => ['nullable', 'integer', 'exists:cities,id'],
            'service_id'       => ['nullable', 'integer', 'exists:services,id'],
            'title'            => ['nullable', 'string', 'max:255'],
            'slug'             => ['nullable', 'string', 'max:255', Rule::unique('projects', 'slug')->ignore($projectId)],
            'description'      => ['nullable', 'string'],
            'location_address' => ['nullable', 'string', 'max:255'],
            'is_featured'      => ['nullable', 'boolean'],
            'status'           => ['nullable', 'in:active,inactive,draft'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_desc'        => ['nullable', 'string'],
        ];
    }
}
