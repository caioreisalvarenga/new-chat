<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthenticateUserService;

class AuthenticateUser extends Controller
{

    protected $authenticateUserService;

    public function __construct(AuthenticateUserService $authenticateUserService)
    {
        $this->authenticateUserService = $authenticateUserService;
    }

    public function register(RegisterRequest $request)
    {
        return $this->authenticateUserService->register($request);
    }

    public function viewRegister()
    {
        return $this->authenticateUserService->viewRegister();
    }

    public function login(LoginRequest $request)
    {
        return $this->authenticateUserService->login($request);
    }

    public function viewLogin()
    {
        return $this->authenticateUserService->viewLogin();
    }

    public function logout()
    {
        return $this->authenticateUserService->logout();
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
