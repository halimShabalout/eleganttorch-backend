<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends BaseController
{
    protected $authService;
    protected $request;

    // Constructor to inject dependencies: Request and authService
    public function __construct(Request $request, AuthService $authService)
    {
        $this->authService = $authService;
        $this->request = $request;
    }

    public function login()
    {
        $response = $this->authService->login($this->request->all());

        return response()->json($response, $response->status);
    }
}
