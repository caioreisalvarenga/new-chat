<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\alert;

class AuthenticateUserService extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $validateUser = $request->validated();

            if (!$validateUser) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'erros' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
            Log::channel('register')->info('User created successfully');
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => true,
                    'message' => 'User created successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            }
        } catch (\Throwable $th) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                    'erros' => $validateUser->errors()
                ], 500);
            }
        }
    }

    public function viewRegister()
    {
        return view('register');
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $validateUser = $request->validated();

        try {
            if (!$validateUser) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'erros' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'EMAIL or PASSWORD are incorrect',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            Log::channel('register')->info('User' . $user . 'logged in successfully');
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => true,
                    'message' => 'User logged in successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            }
            return redirect(route('api.send.message'));
        } catch (\Throwable $th) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                    'erros' => $validateUser->errors()
                ], 500);
            }
        }
    }

    public function viewLogin()
    {
        return view('login');
    }

    public function logout()
    {
        try {
            $userAuth = auth()->user()->tokens()->delete();
            Log::channel('register')->info('User' . $userAuth . 'logged in successfully');
            return response()->json([
                'status' => true,
                'message' => 'User logged out successfully',
                'data' => [],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to logout',
                'errors' => $th->getMessage(),
            ], 500);
        }
    }

    public function profileIdAuth(): JsonResponse
    {
        try {
            $userData = auth()->user();
            Log::channel('profile')->info('Profile' . $userData . 'logged searched information');
            return response()->json([
                'status' => true,
                'message' => 'Profile Logged Information',
                'data' => $userData,
                'id' => auth()->user()->id
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to logout',
                'errors' => $th->getMessage(),
            ], 500);
        }
    }

    public function allProfile(): JsonResponse
    {
        try {
            $users = User::all();
            Log::channel('profile')->info('Was searched allProfile now');
            return response()->json([
                'status' => true,
                'message' => 'All users here',
                'data' => $users,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to logout',
                'errors' => $th->getMessage(),
            ], 500);
        }
    }

    public function deleteProfile(User $user): JsonResponse
    {
        try {
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $user->delete();
            Log::channel('profile')->info('User deleted successfully');
            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to logout',
                'errors' => $th->getMessage(),
            ], 500);
        }
    }
}
