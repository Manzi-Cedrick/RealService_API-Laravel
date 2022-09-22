<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class Auth extends Controller
{
    //
    public function Register(Request $request){
        $fields = $request->validate([
            'name'=>'required|string',
            'email' =>['required','email','unique:users'],
            'password'=> ['required','min:6','confirmed']
        ]);
        $RegisteredUser = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password'])
        ]);
        $token = $RegisteredUser->createToken('AppToken')->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'User successfully Registered',
            'User' => $RegisteredUser,
            'Token' => $token
        ],200);
    }
    public function Login(Request $request){
        $fields = $request->validate([
            'email' =>['required','email'],
            'password'=> ['required','min:6']
        ]);
        $user = User::where('email',$fields['email'])->first();
        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response()->json([
                'status' => true,
                'message' => 'Bad Credentials',
            ],401);
        }
            $token = $user->createToken('AppToken')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'User Successfully Logged In',
                'User' => $user,
                'Token' => $token
            ],200);
        
    }
    public function Logout(Request $request){
        $accessToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($accessToken);
        if($token->delete()){
        return response()->json([
                'status' => true,
                'message' => 'User successfully Logged Out',
            ],200);
        }
    }
}
