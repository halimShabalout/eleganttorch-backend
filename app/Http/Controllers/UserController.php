<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends BaseController
{
    protected $userService;
    protected $request;

    // Constructor to inject dependencies: Request and userService
    public function __construct(Request $request, UserService $userService)
    {
        $this->userService = $userService;
        $this->request = $request;
    }

    // Get all users
    public function index(): JsonResponse
    {
        $response = $this->userService->getAllUsers($this->request->all());
        return response()->json($response, $response->status);
    }

    // Store a new user
    public function store(): JsonResponse
    {
        $response = $this->userService->createUser($this->request->all());
        return response()->json($response, $response->status);
    }

    // Show a specific user
    public function show($id): JsonResponse
    {
        $response = $this->userService->getUserById($id);
        return response()->json($response, $response->status);
    }

    // Update a specific user
    public function update($id): JsonResponse
    {
        $response = $this->userService->updateUser($id, $this->request->all());
        return response()->json($response, $response->status);
    }

    // Delete a user
    public function destroy($id): JsonResponse
    {
        $response  = $this->userService->deleteUser($id);
        return response()->json($response, $response->status);
    }
}
