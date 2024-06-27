<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticateUserService extends Controller
{
    public function register(Request $request): JsonResponse
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);

            if ($validateUser->fails()) {
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

            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'erros' => $validateUser->errors()
            ], 500);
        }
    }

    public function viewRegister()
    {
        return view('register');
    }
    
    public function login(Request $request): JsonResponse
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validateUser->fails()) {
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
            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'erros' => $validateUser->errors()
            ], 500);
        }
    }

    public function viewLogin()
    {
        return view('login');
    }

    public function logout(){
        try {
            auth()->user()->tokens()->delete();
    
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