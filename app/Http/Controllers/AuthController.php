<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function userRegister(Request $request)
    {
        // Basic validation on incoming data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        // If validation fails, return an error response
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Generate a token for the user
        $token = auth('api')->login($user);

        if (!$token) {
            return response()->json([
                'status' => false,
                'message' => 'No se pudo generar el token',
            ], 422);
        }

        // Response
        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function userLogin(Request $request)
    {
        // Validation on incoming data
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8'
        ]);

        // If validation fails, return an error response
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Authenticattion of the crendentials
        $token = JWTAuth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        // If the is empty, return an error response
        if (empty($token)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid login details',
            ], 422);
        }

        // Response
        return response()->json([
            'status' => true,
            'message' => 'User logged successfully',
            'token' => $token
        ], 201);
    }

    public function userProfile()
    {
        // User profile
        $userData = auth('api')->user();

        // Response
        return response()->json([
            'status' => true,
            'message' => 'Profile data',
            'user' => $userData
        ], 201);
    }

    function refreshToken()
    {
        // New token generated
        $newToken = JWTAuth::parseToken()->refresh();

        // Response
        return response()->json([
            'status' => true,
            'message' => 'New Access token generated',
            'token' => $newToken
        ], 201);
    }

    function userLogout()
    {
        // User logout
        auth()->logout();

        // Response
        return response()->json([
            'status' => true,
            'message' => 'User logged out successfully'
        ], 201);
    }
}
