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

    public function viewRegister()
    {
        return $this->authenticateUserService->viewRegister();
    }

    public function login(Request $request)
    {
        return $this->authenticateUserService->login($request);
    }

    public function logout(Request $request)
    {
        return $this->authenticateUserService->logout($request);
    }

    public function profileIdAuth()
    {
        return $this->authenticateUserService->profileIdAuth();
    }

    public function allProfile()
    {
        return $this->authenticateUserService->allProfile();
    }

    public function deleteProfile(User $user)
    {
        return $this->authenticateUserService->deleteProfile($user);
    }
}
