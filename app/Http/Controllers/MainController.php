<?php

namespace App\Http\Controllers;

use App\Services\MainService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MainController extends BaseController
{
    protected $mainService;
    protected $request;

    // Constructor to inject dependencies: Request and mainService
    public function __construct(Request $request, MainService $mainService)
    {
        $this->mainService = $mainService;
        $this->request = $request;
    }
    // Get all main's
    public function index(): JsonResponse
    {
        $response = $this->mainService->getAllMains($this->request->all());
        return response()->json($response, $response->status);
    }

    // Store a new main
    public function store(): JsonResponse
    {
        $response = $this->mainService->createMain($this->request->all());
        return response()->json($response, $response->status);
    }

    // Show a specific main
    public function show($id): JsonResponse
    {
        $response = $this->mainService->getMainById($id);
        return response()->json($response, $response->status);
    }

    // Update a specific main
    public function update($id): JsonResponse
    {
        $response = $this->mainService->updateMain($id, $this->request->all());
        return response()->json($response, $response->status);
    }

    // Delete a main
    public function destroy($id): JsonResponse
    {
        $response  = $this->mainService->deleteMain($id);
        return response()->json($response, $response->status);
    }
}
