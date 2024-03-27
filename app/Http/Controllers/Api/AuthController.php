<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

use Swagger\Annotations as SWG;

use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use HasApiTokens;

    /*
     * @param Request $request
     * @param CreateNewUser $creator
     * @return JsonResponse
     */
    public function register(Request $request, CreateNewUser $creator): JsonResponse
    {
        $input =[
            'name' =>$request->name ,
            'email' => $request->email,
            'phone' => $request->phone,
            'lion_id' => $request->lion_id,
            'password' => $request->password,
            'terms' => $request->terms,
            'password_confirmation'=> $request->password_confirmation,
        ];
        try {
            $user = $creator->create($input);
            $token = $user->createToken('api_token')->plainTextToken;
            return response()->json(['message' => 'Registration successful', 'user' => $user, 'token' => $token], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to register user , '.$e->getMessage()], 500);
        }
    }
        public function login(Request $request)
        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $token = $user->createToken('api_token')->plainTextToken;

                return response()->json([
                    'message' => 'Login successful',
                    'user' => $user,
                    'token' => $token,
                ]);
            }

            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        public function logout(Request $request)
        {
            $user = $request->user();
            $user->tokens()->delete();

            return response()->json(['message' => 'Logout successful']);
        }
}

