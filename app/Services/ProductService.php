<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use App\Models\Product;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class ProductService extends BaseService
{
    public function validatedData(): array
    {
        return [
            'product_name'        => 'nullable|string|max:255',
            'description'         => 'nullable|string|max:255',
            'images'              => 'nullable|json',
            'is_active'           => 'nullable|boolean',
            'category_id'         => 'nullable|string|max:255'
        ];
    }
    /**
     * Get all product.
     */
    public function getAllProduct(): ServiceResponse
    {
        return $this->setResponse(200, 'Success', Product::all());
    }

    /**
     * Create a new product.
     */
    public function createProduct(array $data): ServiceResponse
    {

        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);

        $product = new Product($data);
        return $product->save() ? $this->setResponse(200, 'product successfully created', $product) : $this->setResponse(500, 'Something Went Wrong !', null);
  
    }

    /**
     * Get a specific product by ID.
     */
    public function getProductById($id)
    {
        $product = Product::find($id);
        return $product ? $this->setResponse(200, 'Success', $product) : $this->setResponse(404, 'Not Found', null);
    }

    /**
     * Update an existing product.
     */
    public function updateProduct($id, array $data)
    {
        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);
        
        $product = Product::find($id);
        
        if (!$product) return $this->setResponse(404, 'Not Found', null);
        return $product->update($data) ? $this->setResponse(200, 'Updated', $product) : $this->setResponse(500, 'Something Went Wrong', null);
  
    }

    /**
     * Delete a product.
     */
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if (!$product) return $this->setResponse(404, 'Not Found', null);
        return $product->delete() ? $this->setResponse(200, 'product deleted successfully.', $product) : $this->setResponse(500, 'Something Went Wrong', null);
    }
}
