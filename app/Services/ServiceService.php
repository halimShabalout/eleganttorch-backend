<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use App\Models\Service;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class ServiceService extends BaseService
{
    public function validatedData(): array
    {
        return [
            'title'        => 'nullable|string|max:255',
            'text'        => 'nullable|string|max:255',
            'image'        => 'nullable|string|max:255'
        ];
    }
    /**
     * Get all service.
     */
    public function getAllservice(): ServiceResponse
    {
        return $this->setResponse(200, 'Success', service::all());
    }

    /**
     * Create a new service.
     */
    public function createservice(array $data): ServiceResponse
    {

        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);

        $service = new Service($data);
        return $service->save() ? $this->setResponse(200, 'service successfully created', $service) : $this->setResponse(500, 'Something Went Wrong !', null);
  
    }

    /**
     * Get a specific service by ID.
     */
    public function getserviceById($id)
    {
        $service = Service::find($id);
        return $service ? $this->setResponse(200, 'Success', $service) : $this->setResponse(404, 'Not Found', null);
    }

    /**
     * Update an existing service.
     */
    public function updateservice($id, array $data)
    {
        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);
        
        $service = Service::find($id);
        
        if (!$service) return $this->setResponse(404, 'Not Found', null);
        return $service->update($data) ? $this->setResponse(200, 'Updated', $service) : $this->setResponse(500, 'Something Went Wrong', null);
  
    }

    /**
     * Delete a service.
     */
    public function deleteservice($id)
    {
        $service = Service::find($id);
        if (!$service) return $this->setResponse(404, 'Not Found', null);
        return $service->delete() ? $this->setResponse(200, 'service deleted successfully.', $service) : $this->setResponse(500, 'Something Went Wrong', null);
    }
}
