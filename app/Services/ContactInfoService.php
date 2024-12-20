<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use App\Models\ContactInformation;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;


class ContactInfoService extends BaseService
{
    public function validatedData(): array
    {
        return [
            'address'               => 'nullable|string|max:255',
            'phone_number'          => 'nullable|string|max:15|regex:/^[0-9+\-\(\) ]+$/',
            'email'                 => 'nullable|string|email|max:255|unique:users,email',
            'linkedIn_link'         => 'nullable|string|max:255',
            'instagram_link'        => 'nullable|string|max:255',
            'tiktok_link'           => 'nullable|string|max:255',
            'snap_link'             => 'nullable|string|max:255'
        ];
    }
    /**
     * Get all ContactInfo.
     */
    public function getAllContactInfo(): ServiceResponse
    {
        return $this->setResponse(200, 'Success', ContactInformation::all());
    }

    /**
     * Create a new ContactInfo.
     */
    public function createContactInfo(array $data): ServiceResponse
    {

        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);

        $contactInfo = new ContactInformation($data);
        return $contactInfo->save() ? $this->setResponse(200, 'ContactInfo successfully created', $contactInfo) : $this->setResponse(500, 'Something Went Wrong !', null);
  
    }

    /**
     * Get a specific ContactInformation by ID.
     */
    public function getContactInfoById($id)
    {
        $contactInfo = ContactInformation::find($id);
        return $contactInfo ? $this->setResponse(200, 'Success', $contactInfo) : $this->setResponse(404, 'Not Found', null);
    }

    /**
     * Update an existing contactInfo.
     */
    public function updateContactInfo($id, array $data)
    {
        $validator = Validator::make($data, $this->validatedData(), Lang::get('validation'));
        if ($validator->fails()) return $this->setResponse(406, $validator->errors(), null);
        
        $contactInfo = ContactInformation::find($id);
        
        if (!$contactInfo) return $this->setResponse(404, 'Not Found', null);
        return $contactInfo->update($data) ? $this->setResponse(200, 'Updated', $contactInfo) : $this->setResponse(500, 'Something Went Wrong', null);
  
    }

    /**
     * Delete a contactInfo.
     */
    public function deleteContactInfo($id)
    {
        $contactInfo = ContactInformation::find($id);
        if (!$contactInfo) return $this->setResponse(404, 'Not Found', null);
        return $contactInfo->delete() ? $this->setResponse(200, 'contactInfo deleted successfully.', $contactInfo) : $this->setResponse(500, 'Something Went Wrong', null);
    }
}
