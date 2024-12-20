<?php

namespace App\Http\Controllers;

use App\Services\VisionService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VisionController extends BaseController
{
    protected $visionService;
    protected $request;

    // Constructor to inject dependencies: Request and visionService
    public function __construct(Request $request, VisionService $visionService)
    {
        $this->visionService = $visionService;
        $this->request = $request;
    }
    // Get all contactInfo's
    public function index(): JsonResponse
    {
        $response = $this->contactInfoService->getAllContactInfo($this->request->all());
        return response()->json($response, $response->status);
    }

    // Store a new contactInfo
    public function store(): JsonResponse
    {
        $response = $this->contactInfoService->createContactInfo($this->request->all());
        return response()->json($response, $response->status);
    }

    // Show a specific contactInfo
    public function show($id): JsonResponse
    {
        $response = $this->contactInfoService->getContactInfoById($id);
        return response()->json($response, $response->status);
    }

    // Update a specific contactInfo
    public function update($id): JsonResponse
    {
        $response = $this->contactInfoService->updateContactInfo($id, $this->request->all());
        return response()->json($response, $response->status);
    }

    // Delete a contactInfo
    public function destroy($id): JsonResponse
    {
        $response  = $this->contactInfoService->deleteContactInfo($id);
        return response()->json($response, $response->status);
    }
}
