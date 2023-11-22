<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpres\ResponseFormatter;
use Laravel\Fortify\Rules\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' =>['required', 'string', 'max:225'],
                'username' =>['required', 'string', 'max:225', 'unique:users'],
                'email' =>['required', 'string', 'email', 'max:225', 'unique:users'],
                'phone' =>['nullable', 'string', 'max:225'],
                'password' =>['required', 'string', new Password],
            ]);

            User::create([
                'name' => $request->name,
                'unsername' => $request->unsername,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'User Registered');
        }catch (Exception $error) {
            return ResponseFormatter::success([
                'message' => 'Shomething went worng',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
}
