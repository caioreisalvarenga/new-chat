<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthenticateUser extends Controller
{

    protected $authenticateUserService;

    public function __construct(AuthenticateUserService $authenticateUserService)
    {
        $this->authenticateUserService = $authenticateUserService;
    }

    public function register(Request $request)
    {
        $this->authenticateUserService->register($request);
    }

    public function login(Request $request)
    {
        $this->authenticateUserService->login($request);
    }

    public function profileIdAuth()
    {
        $this->authenticateUserService->profileIdAuth();
    }

    public function allProfile(Request $request)
    {
        $this->authenticateUserService->allProfile($request);
    }

    public function deleteProfile(User $user)
    {
        $this->authenticateUserService->deleteProfile($user);
    }
}
