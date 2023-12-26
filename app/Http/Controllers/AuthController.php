<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $createdUser = $this->userRepository->insertOne($validatedData);

        $access_token = $createdUser->createToken('access_token')->plainTextToken;

        $response = [
            "user" => $createdUser,
            "access_token" => $access_token
        ];

        return response()->ok($response);
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $existingUser = $this->userRepository->findOne(["email" => $validatedData["email"]]);

        if (!$existingUser || !Hash::check(($validatedData["password"]), $existingUser->password)) {
            return response()->unauthorized();
        }

        $access_token = $existingUser->createToken('access_token')->plainTextToken;

        $response = [
            "access_token" => $access_token
        ];

        return response()->ok($response);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->ok("Logout successfully");
    }
}
