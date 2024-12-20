<?php

namespace App\Http\Controllers;

use App\Services\AboutUsService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AboutUsController extends BaseController
{
    protected $aboutUsService;
    protected $request;

    // Constructor to inject dependencies: Request and aboutUsService
    public function __construct(Request $request, AboutUsService $aboutUsService)
    {
        $this->aboutUsService = $aboutUsService;
        $this->request = $request;
    }
    // Get all aboutUs's
    public function index(): JsonResponse
    {
        $response = $this->aboutUsService->getAllAboutUs($this->request->all());
        return response()->json($response, $response->status);
    }

    // Store a new aboutUs
    public function store(): JsonResponse
    {
        $response = $this->aboutUsService->createAboutUs($this->request->all());
        return response()->json($response, $response->status);
    }

    // Show a specific aboutUs
    public function show($id): JsonResponse
    {
        $response = $this->aboutUsService->getAboutUsById($id);
        return response()->json($response, $response->status);
    }

    // Update a specific aboutUs
    public function update($id): JsonResponse
    {
        $response = $this->aboutUsService->updateAboutUs($id, $this->request->all());
        return response()->json($response, $response->status);
    }

    // Delete a aboutUs
    public function destroy($id): JsonResponse
    {
        $response  = $this->aboutUsService->deleteAboutUs($id);
        return response()->json($response, $response->status);
    }
}
