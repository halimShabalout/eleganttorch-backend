<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;

class CustomerService extends BaseService
{
    /**
     * Get all customers.
     */
    public function getAllCustomers(): ServiceResponse
    {
        return $this->setResponse(200, 'Success', Customer::all());
    }

    /**
     * Create a new customer.
     */
    public function createCustomer(array $data)
    {
        // Handle logo file upload
        if (isset($data['logo'])) {
            $data['logo'] = $data['logo']->store('logos', 'public');
        }
        return $this->setResponse(200, 'Success', Customer::create($data));

    }

    /**
     * Get a specific customer by ID.
     */
    public function getCustomerById($id)
    {
        $customer =  Customer::find($id);
        return $customer ? $this->setResponse(200, 'Success', $customer) : $this->setResponse(404, 'Not Found', null);
    }

    /**
     * Update an existing customer.
     */
    public function updateCustomer($id, array $data)
    {
        $customer = Customer::findOrFail($id);

        // Handle logo file upload if present
        if (isset($data['logo'])) {
            // Delete the old logo if a new one is uploaded
            if ($customer->logo) {
                Storage::disk('public')->delete($customer->logo);
            }

            $data['logo'] = $data['logo']->store('logos', 'public');
        }

        $customer->update($data);
        return $customer;
    }

    /**
     * Delete a customer.
     */
    public function deleteCustomer($id): ServiceResponse
    {
        $customer = Customer::find($id);
        if (!$customer) return $this->setResponse(404, 'Not Found', null);
        return $customer->delete() ? $this->setResponse(200, 'customer deleted successfully.', $customer) : $this->setResponse(500, 'Something Went Wrong', null);
    }
}
