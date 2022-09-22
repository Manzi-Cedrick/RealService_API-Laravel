<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;

class Auth extends Controller
{
    //
    public function Register(Request $request){
        $RegisteredUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json([
            'status' => true,
            'message' => 'User successfully Registered',
            'User' => $RegisteredUser,
        ],200);
    }
    public function Login(LoginRequest $request){
        if(FacadesAuth::attempt($request->only('email','password'))){
            return response()->json([
                'status' => true,
                'message' => 'User successfully Login Success',
                'User' => FacadesAuth::user()
            ],200);
        }
    }
}
