<?php

namespace App\Http\Controllers;

use App\Services\SubCategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SubCategoryController extends Controller
{
    protected $subCategoryService;
    protected $request;

    // Constructor to inject dependencies: Request and subCategoryService
    public function __construct(Request $request, SubCategoryService $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService;
        $this->request = $request;
    }

    // Get all subCategories
    public function index(): JsonResponse
    {
        $response = $this->subCategoryService->getAllSubCategories($this->request->all());
        return response()->json($response, $response->status);
    }

    // Store a new subcategory
    public function store(): JsonResponse
    {
        $response = $this->subCategoryService->createSubCategory($this->request->all());
        return response()->json($response, $response->status);
    }

    // Show a specific subcategory
    public function show($id): JsonResponse
    {
        $response = $this->subCategoryService->getSubCategoryById($id);
        return response()->json($response, $response->status);
    }

    // Update a specific subcategory
    public function update($id): JsonResponse
    {
        $response = $this->subCategoryService->updateSubCategory($id, $this->request->all());
        return response()->json($response, $response->status);
    }

    // Delete a subcategory
    public function destroy($id): JsonResponse
    {
        $response = $this->subCategoryService->deleteSubCategory($id);
        return response()->json($response, $response->status);
    }
}

