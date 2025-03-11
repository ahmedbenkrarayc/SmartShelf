<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->validated();

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Credentials don\'t match'
            ], 401);
        }
    
        $user = User::where('email', $request->email)->first();
    
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('token for ' . $user->email)->plainTextToken
        ], 200);
    }
    

    public function register(RegisterRequest $request){
        $request->validated($request->all());

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('token for '.$user->email)->plainTextToken
        ], 201);
    }

    public function logout(){
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'You have been logged out'
        ], 200);
    }
}
