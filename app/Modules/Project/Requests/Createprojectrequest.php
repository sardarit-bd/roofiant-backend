<?php

namespace App\Modules\Project\Requests;

use App\Http\Requests\BaseRequest;

class CreateProjectRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'city_id'          => ['required', 'integer', 'exists:cities,id'],
            'service_id'       => ['required', 'integer', 'exists:services,id'],
            'title'            => ['required', 'string', 'max:255'],
            'slug'             => ['required', 'string', 'max:255', 'unique:projects,slug'],
            'description'      => ['nullable', 'string'],
            'location_address' => ['nullable', 'string', 'max:255'],
            'is_featured'      => ['nullable', 'boolean'],
            'status'           => ['nullable', 'in:active,inactive,draft'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_desc'        => ['nullable', 'string'],
        ];
    }
}
