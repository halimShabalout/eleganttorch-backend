<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use App\Models\Mission;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class MissionService extends BaseService
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
     * Get all mission.
     */
    public function getAllMission(): ServiceResponse
    {
        return $this->setResponse(200, 'Success', Mission::all());
    }

    /**
     * Create a new mission.
     */
    public function createMission(array $data): ServiceResponse
    {

        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);

        $mission = new Mission($data);
        return $mission->save() ? $this->setResponse(200, 'mission successfully created', $mission) : $this->setResponse(500, 'Something Went Wrong !', null);
  
    }

    /**
     * Get a specific mission by ID.
     */
    public function getMissionById($id)
    {
        $mission = Mission::find($id);
        return $mission ? $this->setResponse(200, 'Success', $mission) : $this->setResponse(404, 'Not Found', null);
    }

    /**
     * Update an existing mission.
     */
    public function updateMission($id, array $data)
    {
        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);
        
        $mission = Mission::find($id);
        
        if (!$mission) return $this->setResponse(404, 'Not Found', null);
        return $mission->update($data) ? $this->setResponse(200, 'Updated', $mission) : $this->setResponse(500, 'Something Went Wrong', null);
  
    }

    /**
     * Delete a mission.
     */
    public function deleteMission($id)
    {
        $mission = Mission::find($id);
        if (!$mission) return $this->setResponse(404, 'Not Found', null);
        return $mission->delete() ? $this->setResponse(200, 'mission deleted successfully.', $mission) : $this->setResponse(500, 'Something Went Wrong', null);
    }
}
