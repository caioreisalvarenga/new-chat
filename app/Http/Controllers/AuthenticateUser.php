<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthenticateUserService;

class AuthenticateUser extends Controller
{

    protected $authenticateUserService;

    public function __construct(AuthenticateUserService $authenticateUserService)
    {
        $this->authenticateUserService = $authenticateUserService;
    }

    public function register(Request $request)
    {
        return $this->authenticateUserService->register($request);
    }

    public function login(Request $request)
    {
        return $this->authenticateUserService->login($request);
    }

    public function profileIdAuth()
    {
        return $this->authenticateUserService->profileIdAuth();
    }

    public function allProfile(Request $request)
    {
        return $this->authenticateUserService->allProfile($request);
    }

    public function deleteProfile(User $user)
    {
        return $this->authenticateUserService->deleteProfile($user);
    }
}
