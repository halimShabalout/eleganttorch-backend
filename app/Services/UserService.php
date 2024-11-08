<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class UserService extends BaseService
{
    public function validatedData(): array
    {
        return [
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'lang'             => 'required|string',
            'phone_number'     => 'required|string|max:15|regex:/^[0-9+\-\(\) ]+$/',
            'position'         => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users,email',
            'password'         => 'required|string|min:1',
            'department_id'    => 'nullable|integer',
            'customer_id'      => 'nullable|integer',
            'is_active'        => 'required|boolean'
        ];
    }
    /**
     * Get all users.
     */
    public function getAllUsers(): ServiceResponse
    {
        return $this->setResponse(200, 'Success', User::all());
    }

    /**
     * Create a new user.
     */
    public function createUser(array $data): ServiceResponse
    {
        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);
        $data['password'] = Hash::make($data['password']);

        $data['department_id'] = $data['department_id'] ?? Auth::user()->department_id;
        $data['customer_id'] = $data['customer_id'] ?? Auth::user()->customer_id;

        $user = new User($data);
        return $user->save() ? $this->setResponse(200, 'User successfully created', $user) : $this->setResponse(500, 'Something Went Wrong !', null);
  
    }

    /**
     * Get a specific user by ID.
     */
    public function getUserById($id)
    {
        $user = User::find($id);
        return $user ? $this->setResponse(200, 'Success', $user) : $this->setResponse(404, 'Not Found', null);
    }

    /**
     * Update an existing user.
     */
    public function updateUser($id, array $data)
    {
        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);
        
        $user = User::find($id);
        
        if (!$user) return $this->setResponse(404, 'Not Found', null);
        return $user->update($data) ? $this->setResponse(200, 'Updated', $user) : $this->setResponse(500, 'Something Went Wrong', null);
  
    }

    /**
     * Delete a user.
     */
    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) return $this->setResponse(404, 'Not Found', null);
        return $user->delete() ? $this->setResponse(200, 'user deleted successfully.', $user) : $this->setResponse(500, 'Something Went Wrong', null);
    }
}
