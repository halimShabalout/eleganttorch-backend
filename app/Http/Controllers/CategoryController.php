<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{
    protected $categoryService;
    protected $request;

    // Constructor to inject dependencies: Request and categoryService
    public function __construct(Request $request, CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->request = $request;
    }
    // Get all category's
    public function index(): JsonResponse
    {
        $response = $this->categoryService->getAllCategories($this->request->all());
        return response()->json($response, $response->status);
    }

    // Store a new category
    public function store(): JsonResponse
    {
        $response = $this->categoryService->createCategory($this->request->all());
        return response()->json($response, $response->status);
    }

    // Show a specific category
    public function show($id): JsonResponse
    {
        $response = $this->categoryService->getCategoryById($id);
        return response()->json($response, $response->status);
    }

    // Update a specific category
    public function update($id): JsonResponse
    {
        $response = $this->categoryService->updateCategory($id, $this->request->all());
        return response()->json($response, $response->status);
    }

    // Delete a category
    public function destroy($id): JsonResponse
    {
        $response  = $this->categoryService->deleteCategory($id);
        return response()->json($response, $response->status);
    }
}
