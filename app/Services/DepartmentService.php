<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class DepartmentService extends BaseService
{
    public function validatedData(): array
    {
        return [
            'department_name'  => 'required|string|max:255',
            'location'         => 'required|string|max:255',
            'description'      => 'nullable|string',
            'customer_id'      => 'required|integer',
        ];
    }
    /**
     * Get all departments.
     */
    public function getAllDepartments(): ServiceResponse
    {
        return $this->setResponse(200, 'Success', Department::all());
    }

    /**
     * Create a new department.
     */
    public function createDepartment(array $data): ServiceResponse
    {
        $data['customer_id'] = Auth::user()->customer_id;

        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);

        $department = new Department($data);
        return $department->save() ? $this->setResponse(200, 'department created successfully', $department) : $this->setResponse(500, 'Something Went Wrong', $department);
    
    }

    /**
     * Get a specific department by ID.
     */
    public function getDepartmentById($id)
    {
        $department = Department::find($id);
        return $department ? $this->setResponse(200, 'Success', $department) : $this->setResponse(404, 'Not Found', null);
    }

    /**
     * Update an existing department.
     */
    public function updateDepartment($id, array $data)
    {
        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);
        
        $department = Department::find($id);
        
        if (!$department) return $this->setResponse(404, 'Not Found', null);
        return $department->update($data) ? $this->setResponse(200, 'Updated', $department) : $this->setResponse(500, 'Something Went Wrong', null);
  
    }

    /**
     * Delete a department.
     */
    public function deleteDepartment($id)
    {
        $department = Department::find($id);
        if (!$department) return $this->setResponse(404, 'Not Found', null);
        return $department->delete() ? $this->setResponse(200, 'department deleted successfully.', $department) : $this->setResponse(500, 'Something Went Wrong', null);
    }
}
