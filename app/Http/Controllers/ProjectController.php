<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProjectController extends BaseController
{
    protected $projectService;
    protected $request;

    // Constructor to inject dependencies: Request and projectService
    public function __construct(Request $request, ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->request = $request;
    }
    // Get all project's
    public function index(): JsonResponse
    {
        $response = $this->projectService->getAllProject($this->request->all());
        return response()->json($response, $response->status);
    }

    // Store a new project
    public function store(): JsonResponse
    {
        $response = $this->projectService->createProject($this->request->all());
        return response()->json($response, $response->status);
    }

    // Show a specific project
    public function show($id): JsonResponse
    {
        $response = $this->projectService->getProjectById($id);
        return response()->json($response, $response->status);
    }

    // Update a specific project
    public function update($id): JsonResponse
    {
        $response = $this->projectService->updateProject($id, $this->request->all());
        return response()->json($response, $response->status);
    }

    // Delete a project
    public function destroy($id): JsonResponse
    {
        $response  = $this->projectService->deleteProject($id);
        return response()->json($response, $response->status);
    }
}
