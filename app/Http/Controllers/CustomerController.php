<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class CustomerController extends BaseController
{
    protected $customerService;
    protected $request;

    // Constructor to inject dependencies: Request and CustomerService
    public function __construct(Request $request, CustomerService $customerService)
    {
        $this->customerService = $customerService;
        $this->request = $request;
    }

    // Get all customers
    public function index(): JsonResponse
    {
        $response = $this->customerService->getAllCustomers($this->request->all());
        return response()->json($response, $response->status);
   }

    // Store a new customer
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:tb_customers,email',
            'contact_person' => 'required|string|max:255',
            'commercial_record' => 'nullable|string',
            'tax_number' => 'nullable|string',
        ]);

        $customer = $this->customerService->createCustomer($validatedData);
        return response()->json($customer, Response::HTTP_CREATED);
    }

    // Show a specific customer
    public function show($id): JsonResponse
    {
        $response = $this->customerService->getCustomerById($id);
        return response()->json($response, $response->status);
    }

    // Update a specific customer
    public function update($id): JsonResponse
    {
        $validatedData = $this->request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:tb_customers,email,' . $id,
            'contact_person' => 'required|string|max:255',
            'commercial_record' => 'nullable|string',
            'tax_number' => 'nullable|string',
        ]);

        $customer = $this->customerService->updateCustomer($id, $validatedData);
        return response()->json($customer, Response::HTTP_OK);
    }

    // Delete a customer
    public function destroy($id): JsonResponse
    {
        $response = $this->customerService->deleteCustomer($id);
        return response()->json($response, $response->status);
    }
}
