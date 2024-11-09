<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class SubCategoryService extends BaseService
{
    public function validatedData(): array
    {
        return [
            'sub_category_name'   => 'required|string|max:255',
            'description'         => 'nullable|string',
            'category_id'         => 'required|integer',
            'customer_id'         => 'required|integer',
        ];
    }
    /**
     * Get all subCategories.
     */
    public function getAllSubCategories(): ServiceResponse
    {
        return $this->setResponse(200, 'Success', SubCategory::all());
    }

    /**
     * Create a new subCategory.
     */
    public function createSubCategory(array $data): ServiceResponse
    {
        $data['customer_id'] = Auth::user()->customer_id;

        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);

        $subcategory = new SubCategory($data);
        return $subcategory->save() ? $this->setResponse(200, 'subcategory created successfully', $subcategory) : $this->setResponse(500, 'Something Went Wrong', $subcategory);
    
    }

    /**
     * Get a specific subcategory by ID.
     */
    public function getSubCategoryById($id)
    {
        $subcategory = Subcategory::find($id);
        return $subcategory ? $this->setResponse(200, 'Success', $subcategory) : $this->setResponse(404, 'Not Found', null);
    }

    /**
     * Update an existing subcategory.
     */
    public function updateSubCategory($id, array $data)
    {
        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);
        
        $subcategory = Subcategory::find($id);
        
        if (!$subcategory) return $this->setResponse(404, 'Not Found', null);
        return $subcategory->update($data) ? $this->setResponse(200, 'Updated', $subcategory) : $this->setResponse(500, 'Something Went Wrong', null);
  
    }

    /**
     * Delete a subcategory.
     */
    public function deleteSubCategory($id)
    {
        $subcategory = Subcategory::find($id);
        if (!$subcategory) return $this->setResponse(404, 'Not Found', null);
        return $subcategory->delete() ? $this->setResponse(200, 'subcategory deleted successfully.', $subcategory) : $this->setResponse(500, 'Something Went Wrong', null);
    }
}
