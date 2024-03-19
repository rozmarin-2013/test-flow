<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function login(LoginRequest $request): \Illuminate\Foundation\Application|Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $user = $this->register($request);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response(['message' => 'Invalid Credentials'], Response::HTTP_UNAUTHORIZED);
        }

        return response([
            'access_token' => $user->createToken($user->name . '-AuthToken')->plainTextToken
        ]);
    }

    private function register($request)
    {
        return User::create(
            [
                'name' => 'Guest',
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]
        );
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'logged out']);
    }

}
