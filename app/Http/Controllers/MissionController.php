<?php

namespace App\Http\Controllers;

use App\Services\MissionService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MissionController extends BaseController
{
    protected $missionService;
    protected $request;

    // Constructor to inject dependencies: Request and missionService
    public function __construct(Request $request, MissionService $missionService)
    {
        $this->missionService = $missionService;
        $this->request = $request;
    }
    // Get all mission's
    public function index(): JsonResponse
    {
        $response = $this->missionService->getAllMission($this->request->all());
        return response()->json($response, $response->status);
    }

    // Store a new mission
    public function store(): JsonResponse
    {
        $response = $this->missionService->createMission($this->request->all());
        return response()->json($response, $response->status);
    }

    // Show a specific mission
    public function show($id): JsonResponse
    {
        $response = $this->missionService->getMissionById($id);
        return response()->json($response, $response->status);
    }

    // Update a specific mission
    public function update($id): JsonResponse
    {
        $response = $this->missionService->updateMission($id, $this->request->all());
        return response()->json($response, $response->status);
    }

    // Delete a mission
    public function destroy($id): JsonResponse
    {
        $response  = $this->missionService->deleteMission($id);
        return response()->json($response, $response->status);
    }
}
