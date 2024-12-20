<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class AboutUsService extends BaseService
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
     * Get all aboutUs.
     */
    public function getAllAboutUs(): ServiceResponse
    {
        return $this->setResponse(200, 'Success', aboutUs::all());
    }

    /**
     * Create a new aboutUs.
     */
    public function createAboutUs(array $data): ServiceResponse
    {

        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);

        $aboutUs = new AboutUs($data);
        return $aboutUs->save() ? $this->setResponse(200, 'aboutUs successfully created', $aboutUs) : $this->setResponse(500, 'Something Went Wrong !', null);
  
    }

    /**
     * Get a specific aboutUs by ID.
     */
    public function getAboutUsById($id)
    {
        $aboutUs = AboutUs::find($id);
        return $aboutUs ? $this->setResponse(200, 'Success', $aboutUs) : $this->setResponse(404, 'Not Found', null);
    }

    /**
     * Update an existing aboutUs.
     */
    public function updateAboutUs($id, array $data)
    {
        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);
        
        $aboutUs = AboutUs::find($id);
        
        if (!$aboutUs) return $this->setResponse(404, 'Not Found', null);
        return $aboutUs->update($data) ? $this->setResponse(200, 'Updated', $aboutUs) : $this->setResponse(500, 'Something Went Wrong', null);
  
    }

    /**
     * Delete a aboutUs.
     */
    public function deleteAboutUs($id)
    {
        $aboutUs = AboutUs::find($id);
        if (!$aboutUs) return $this->setResponse(404, 'Not Found', null);
        return $aboutUs->delete() ? $this->setResponse(200, 'aboutUs deleted successfully.', $aboutUs) : $this->setResponse(500, 'Something Went Wrong', null);
    }
}
