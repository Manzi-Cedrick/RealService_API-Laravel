<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Auth extends Controller
{
    //
    public function Register(RegisterRequest $request){
        $RegisteredUser = User::create([
            'name' => $request->name,
            'Telephone' => $request->telephone,
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
        if(Auth)
    }
}
