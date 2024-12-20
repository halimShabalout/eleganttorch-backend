<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use App\Models\Project;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class ProjectService extends BaseService
{
    public function validatedData(): array
    {
        return [
            'project_name'        => 'nullable|string|max:255',
            'message'             => 'nullable|string|max:255',
            'description'         => 'nullable|string|max:255',
            'date'                => 'nullable|date|max:255',
            'images'              => 'nullable|json',
            'video'               => 'nullable|string',
            'is_active'           => 'nullable|boolean'
        ];
    }
    /**
     * Get all project.
     */
    public function getAllProject(): ServiceResponse
    {
        return $this->setResponse(200, 'Success', Project::all());
    }

    /**
     * Create a new project.
     */
    public function createProject(array $data): ServiceResponse
    {

        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);

        $project = new Project($data);
        return $project->save() ? $this->setResponse(200, 'project successfully created', $project) : $this->setResponse(500, 'Something Went Wrong !', null);
  
    }

    /**
     * Get a specific project by ID.
     */
    public function getProjectById($id)
    {
        $project = Project::find($id);
        return $project ? $this->setResponse(200, 'Success', $project) : $this->setResponse(404, 'Not Found', null);
    }

    /**
     * Update an existing project.
     */
    public function updateProject($id, array $data)
    {
        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);
        
        $project = Project::find($id);
        
        if (!$project) return $this->setResponse(404, 'Not Found', null);
        return $project->update($data) ? $this->setResponse(200, 'Updated', $project) : $this->setResponse(500, 'Something Went Wrong', null);
  
    }

    /**
     * Delete a project.
     */
    public function deleteProject($id)
    {
        $project = Project::find($id);
        if (!$project) return $this->setResponse(404, 'Not Found', null);
        return $project->delete() ? $this->setResponse(200, 'project deleted successfully.', $project) : $this->setResponse(500, 'Something Went Wrong', null);
    }
}
