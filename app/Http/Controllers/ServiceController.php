<?php

namespace App\Http\Controllers;

use App\Services\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ServiceController extends BaseController
{
    protected $serviceService;
    protected $request;

    // Constructor to inject dependencies: Request and serviceService
    public function __construct(Request $request, ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
        $this->request = $request;
    }
    // Get all service's
    public function index(): JsonResponse
    {
        $response = $this->serviceService->getAllservice($this->request->all());
        return response()->json($response, $response->status);
    }

    // Store a new service
    public function store(): JsonResponse
    {
        $response = $this->serviceService->createservice($this->request->all());
        return response()->json($response, $response->status);
    }

    // Show a specific service
    public function show($id): JsonResponse
    {
        $response = $this->serviceService->getserviceById($id);
        return response()->json($response, $response->status);
    }

    // Update a specific service
    public function update($id): JsonResponse
    {
        $response = $this->serviceService->updateservice($id, $this->request->all());
        return response()->json($response, $response->status);
    }

    // Delete a service
    public function destroy($id): JsonResponse
    {
        $response  = $this->serviceService->deleteservice($id);
        return response()->json($response, $response->status);
    }
}
