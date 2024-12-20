<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use App\Models\Main;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class MainService extends BaseService
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
    public function getAllMains(): ServiceResponse
    {
        return $this->setResponse(200, 'Success', Main::all());
    }

    /**
     * Create a new vision.
     */
    public function createMain(array $data): ServiceResponse
    {

        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);

        $vision = new Main($data);
        return $vision->save() ? $this->setResponse(200, 'vision successfully created', $vision) : $this->setResponse(500, 'Something Went Wrong !', null);
  
    }

    /**
     * Get a specific main by ID.
     */
    public function getMainById($id)
    {
        $main = Main::find($id);
        return $main ? $this->setResponse(200, 'Success', $main) : $this->setResponse(404, 'Not Found', null);
    }

    /**
     * Update an existing main.
     */
    public function updateMain($id, array $data)
    {
        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);
        
        $main = Main::find($id);
        
        if (!$main) return $this->setResponse(404, 'Not Found', null);
        return $main->update($data) ? $this->setResponse(200, 'Updated', $main) : $this->setResponse(500, 'Something Went Wrong', null);
  
    }

    /**
     * Delete a main.
     */
    public function deleteMain($id)
    {
        $main = Main::find($id);
        if (!$main) return $this->setResponse(404, 'Not Found', null);
        return $main->delete() ? $this->setResponse(200, 'main deleted successfully.', $main) : $this->setResponse(500, 'Something Went Wrong', null);
    }
}
