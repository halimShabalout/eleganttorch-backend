<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use App\Models\Category;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class CategoryService extends BaseService
{
    public function validatedData(): array
    {
        return [
            'category_name'        => 'nullable|string|max:255',
            'description'          => 'nullable|string|max:255',
        ];
    }
    /**
     * Get all category.
     */
    public function getAllCategories(): ServiceResponse
    {
        return $this->setResponse(200, 'Success', Category::all());
    }

    /**
     * Create a new category.
     */
    public function createCategory(array $data): ServiceResponse
    {

        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);

        $category = new Category($data);
        return $category->save() ? $this->setResponse(200, 'category successfully created', $category) : $this->setResponse(500, 'Something Went Wrong !', null);
  
    }

    /**
     * Get a specific category by ID.
     */
    public function getCategoryById($id)
    {
        $category = Category::find($id);
        return $category ? $this->setResponse(200, 'Success', $category) : $this->setResponse(404, 'Not Found', null);
    }

    /**
     * Update an existing category.
     */
    public function updateCategory($id, array $data)
    {
        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);
        
        $category = Category::find($id);
        
        if (!$category) return $this->setResponse(404, 'Not Found', null);
        return $category->update($data) ? $this->setResponse(200, 'Updated', $category) : $this->setResponse(500, 'Something Went Wrong', null);
  
    }

    /**
     * Delete a category.
     */
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if (!$category) return $this->setResponse(404, 'Not Found', null);
        return $category->delete() ? $this->setResponse(200, 'category deleted successfully.', $Category) : $this->setResponse(500, 'Something Went Wrong', null);
    }
}
