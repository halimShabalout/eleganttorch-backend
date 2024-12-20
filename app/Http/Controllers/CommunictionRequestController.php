<?php

namespace App\Http\Controllers;

use App\Services\CommunictionRequestService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CommunictionRequestController extends BaseController
{
    protected $communictionRequestService;
    protected $request;

    // Constructor to inject dependencies: Request and communictionRequestService
    public function __construct(Request $request, CommunictionRequestService $communictionRequestService)
    {
        $this->communictionRequestService = $communictionRequestService;
        $this->request = $request;
    }

    // Get all communiction Request's
    public function index(): JsonResponse
    {
        $response = $this->communictionRequestService->getAllContactInfo($this->request->all());
        return response()->json($response, $response->status);
    }

    // Store a new communictionRequest
    public function store(): JsonResponse
    {
        $response = $this->communictionRequestService->createCommunictionRequest($this->request->all());
        return response()->json($response, $response->status);
    }

    // Show a specific communictionRequest
    public function show($id): JsonResponse
    {
        $response = $this->communictionRequestService->getCommunictionRequestById($id);
        return response()->json($response, $response->status);
    }

    // Update a specific communictionRequest
    public function update($id): JsonResponse
    {
        $response = $this->communictionRequestService->updateCommunictionRequest($id, $this->request->all());
        return response()->json($response, $response->status);
    }

    // Delete a communictionRequest
    public function destroy($id): JsonResponse
    {
        $response  = $this->communictionRequestService->deleteCommunictionRequest($id);
        return response()->json($response, $response->status);
    }
}
