<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends BaseController
{
    protected $productService;
    protected $request;

    // Constructor to inject dependencies: Request and productService
    public function __construct(Request $request, ProductService $productService)
    {
        $this->productService = $productService;
        $this->request = $request;
    }
    // Get all product's
    public function index(): JsonResponse
    {
        $response = $this->productService->getAllProduct($this->request->all());
        return response()->json($response, $response->status);
    }

    // Store a new product
    public function store(): JsonResponse
    {
        $response = $this->productService->createProduct($this->request->all());
        return response()->json($response, $response->status);
    }

    // Show a specific product
    public function show($id): JsonResponse
    {
        $response = $this->productService->getProductById($id);
        return response()->json($response, $response->status);
    }

    // Update a specific product
    public function update($id): JsonResponse
    {
        $response = $this->productService->updateProduct($id, $this->request->all());
        return response()->json($response, $response->status);
    }

    // Delete a product
    public function destroy($id): JsonResponse
    {
        $response  = $this->productService->deleteProduct($id);
        return response()->json($response, $response->status);
    }
}
