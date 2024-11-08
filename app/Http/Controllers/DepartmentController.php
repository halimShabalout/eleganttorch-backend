<?php

namespace App\Http\Controllers;

use App\Services\DepartmentService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DepartmentController extends BaseController
{
    protected $departmentService;
    protected $request;

    // Constructor to inject dependencies: Request and departmentService
    public function __construct(Request $request, DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
        $this->request = $request;
    }

    // Get all departments
    public function index(): JsonResponse
    {
        $response = $this->departmentService->getAllDepartments($this->request->all());
        return response()->json($response, $response->status);
    }

    // Store a new department
    public function store(): JsonResponse
    {
        $response = $this->departmentService->createDepartment($this->request->all());
        return response()->json($response, $response->status);
    }

    // Show a specific department
    public function show($id): JsonResponse
    {
        $response = $this->departmentService->getDepartmentById($id);
        return response()->json($response, $response->status);
    }

    // Update a specific department
    public function update($id): JsonResponse
    {
        $response = $this->departmentService->updateDepartment($id, $this->request->all());
        return response()->json($response, $response->status);
    }

    // Delete a department
    public function destroy($id): JsonResponse
    {
        $response = $this->departmentService->deleteDepartment($id);
        return response()->json($response, $response->status);
    }
}
