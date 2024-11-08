<?php

namespace App\Services;

use App\Helpers\ServiceResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthService extends BaseService
{
    public function validatedData(): array
    {
        return [
            'email'      => 'required|max:100|email:rfc',
            'password'   => 'required|max:20|min:1',
        ];
    }

    public function login(array $data): ServiceResponse
    {
        $validator = Validator::make($data, $this->validatedData(), $this->messages());
        if ($validator->fails()) {
            return $this->setResponse(406, $validator->errors(), null);
        }

        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return $this->setResponse(401, 'Email or password is wrong!', null);
        }
    
        $user = Auth::user();
        $user->accessToken = $user->createToken('user-login')->plainTextToken;
        $user->authorized = true;
    
        return $this->setResponse(200, 'Success', $user);
  }
}
