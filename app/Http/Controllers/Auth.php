<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
use OpenApi\Annotations as OA;

class Auth extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Auth"},
     *     summary="Register",
     *     description="Create your account via this endpoint",
     *     operationId="Register",
 *     @OA\RequestBody(
     *      required=true,
     *      description="Enter valid credentials. Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number and one special character.",
     *      @OA\JsonContent(
     *          required={"name","email","password"},
     *          @OA\Property(property="name", type="string", format="name", example="John Doe"),
     *          @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *          @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value",
     *          @OA\JsonContent(
 *                  @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
     *     )
     * )
     */
    public function Register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed']
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
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     summary="Login",
     *     description="Login by email and password",
     *     operationId="Login",
     *     @OA\RequestBody(
     *      required=true,
     *      description="Pass user credentials. Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number and one special character.",
     *      @OA\JsonContent(
     *          required={"email","password"},
     *          @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *          @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function Login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ]);
        $user = User::where('email', $fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'status' => true,
                'message' => 'Bad Credentials',
            ], 401);
        }
        $token = $user->createToken('AppToken')->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'User Successfully Logged In',
            'User' => $user,
            'Token' => $token
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Auth"},
     *     summary="Logout",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="Logout",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function Logout(Request $request)
    {
        $accessToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($accessToken);
        if ($token->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'User successfully Logged Out',
            ], 200);
        }
    }
    public function ForgotPassword(Request $request)
    {
        $user = User::where('email', $request->email);
        if ($user) {
            $token = Str::random(40);
            $domain = URL::to('/');
            $url = $domain . '/reset/password?token=' . $token;
            $data = [
                'url' => $url,
                'email' => $request->email,
                'subject' => 'Password Reset',
                'body' => 'Please Click On the Link Below to reset your Password'
            ];
        }
        try {
            Mail::to('cedrickmanzii0@gmail.com')->send(new MailNotify($data));
            return response()->json([
                'status' => true,
                'message' => 'Email Successfully Sent',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => true,
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}
