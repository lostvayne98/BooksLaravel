<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CheckUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __invoke(CheckUserRequest $request)
    {
       $user = User::whereEmail($request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('api-token')->accessToken;
            return response()->json([
                'user' => $user,
                'access_token' => $token
            ]);
        } else {
            return response()->json([
                'error' => 'Invalid email or password'
            ], 401);
        }
    }
}
