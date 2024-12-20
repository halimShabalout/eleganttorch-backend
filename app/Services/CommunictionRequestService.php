<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use App\Models\CommunictionRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class CommunictionRequestService extends BaseService
{
    public function validatedData(): array
    {
        return [
            'customer_name'        => 'nullable|string|max:255',
            'phone_number'         => 'nullable|string|max:15|regex:/^[0-9+\-\(\) ]+$/',
            'email'                => 'nullable|string|email|max:255|unique:users,email',
            'message'              => 'nullable|string|max:255',
            'is_active'            => 'nullable|boolean'
        ];
    }
    /**
     * Get all communictionRequest.
     */
    public function getAllContactInfo(): ServiceResponse
    {
        return $this->setResponse(200, 'Success', CommunictionRequest::all());
    }

    /**
     * Create a new communictionRequest.
     */
    public function createCommunictionRequest(array $data): ServiceResponse
    {

        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);

        $communictionRequest = new CommunictionRequest($data);
        return $communictionRequest->save() ? $this->setResponse(200, 'communiction request successfully created', $communictionRequest) : $this->setResponse(500, 'Something Went Wrong !', null);
  
    }

    /**
     * Get a specific communictionRequest by ID.
     */
    public function getCommunictionRequestById($id)
    {
        $communictionRequest = CommunictionRequest::find($id);
        return $communictionRequest ? $this->setResponse(200, 'Success', $communictionRequest) : $this->setResponse(404, 'Not Found', null);
    }

    /**
     * Update an existing communictionRequest.
     */
    public function updateCommunictionRequest($id, array $data)
    {
        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);
        
        $communictionRequest = CommunictionRequest::find($id);
        
        if (!$communictionRequest) return $this->setResponse(404, 'Not Found', null);
        return $communictionRequest->update($data) ? $this->setResponse(200, 'Updated', $communictionRequest) : $this->setResponse(500, 'Something Went Wrong', null);
  
    }

    /**
     * Delete a communictionRequest.
     */
    public function deleteCommunictionRequest($id)
    {
        $communictionRequest = CommunictionRequest::find($id);
        if (!$communictionRequest) return $this->setResponse(404, 'Not Found', null);
        return $communictionRequest->delete() ? $this->setResponse(200, 'communiction request deleted successfully.', $communictionRequest) : $this->setResponse(500, 'Something Went Wrong', null);
    }
}
