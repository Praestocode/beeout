<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Constructor: applies Sanctum authentication middleware
     */
    public function __construct()
    {
        // Protected routes require authentication
        $this->middleware('auth:sanctum', ['except' => ['login']]);
    }

    /**
     * Performs login and generates a Sanctum token (for use with API or mobile app)
     */
    public function login(Request $request)
    {
        // Input validation
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user = Auth::user();

        // Create a personal token for API use (when used by a mobile app or SPA)
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    /**
     * Logout and revoke the current token
     */
    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            // Delete only the token used for this request
            $user->currentAccessToken()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Logout successful',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'User not authenticated',
        ], 401);
    }

    /**
     * Returns the data of the authenticated user
     */
    public function me(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'user' => $request->user(),
        ]);
    }
}
?>