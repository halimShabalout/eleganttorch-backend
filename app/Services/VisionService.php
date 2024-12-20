<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use App\Models\Vision;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class VisionService extends BaseService
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
     * Get all vision.
     */
    public function getAllContactInfo(): ServiceResponse
    {
        return $this->setResponse(200, 'Success', Vision::all());
    }

    /**
     * Create a new vision.
     */
    public function createVision(array $data): ServiceResponse
    {

        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);

        $vision = new Vision($data);
        return $vision->save() ? $this->setResponse(200, 'vision successfully created', $vision) : $this->setResponse(500, 'Something Went Wrong !', null);
  
    }

    /**
     * Get a specific vision by ID.
     */
    public function getVisionById($id)
    {
        $vision = Vision::find($id);
        return $vision ? $this->setResponse(200, 'Success', $vision) : $this->setResponse(404, 'Not Found', null);
    }

    /**
     * Update an existing vision.
     */
    public function updateVision($id, array $data)
    {
        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);
        
        $vision = Vision::find($id);
        
        if (!$vision) return $this->setResponse(404, 'Not Found', null);
        return $vision->update($data) ? $this->setResponse(200, 'Updated', $vision) : $this->setResponse(500, 'Something Went Wrong', null);
  
    }

    /**
     * Delete a vision.
     */
    public function deleteCommunictionRequest($id)
    {
        $vision = Vision::find($id);
        if (!$vision) return $this->setResponse(404, 'Not Found', null);
        return $vision->delete() ? $this->setResponse(200, 'vision deleted successfully.', $vision) : $this->setResponse(500, 'Something Went Wrong', null);
    }
}
