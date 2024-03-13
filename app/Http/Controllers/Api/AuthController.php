<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Swagger\Annotations as SWG;


class AuthController extends Controller
{
    /**
     * @SWG\Post(
     *      path="/api/register",
     *      tags={"Auth"},
     *      summary="Registers a new user",
     *      operationId="registerUser",
     *      @SWG\Parameter(
     *          name="name",
     *          in="formData",
     *          required=true,
     *          type="string",
     *          description="User's name"
     *      ),
     *      @SWG\Parameter(
     *          name="email",
     *          in="formData",
     *          required=true,
     *          type="string",
     *          description="User's email"
     *      ),
     *      @SWG\Parameter(
     *          name="phone",
     *          in="formData",
     *          required=true,
     *          type="string",
     *          description="User's phone"
     *      ),
     *      @SWG\Parameter(
     *          name="lion_id",
     *          in="formData",
     *          required=true,
     *          type="string",
     *          description="User's lion ID"
     *      ),
     *      @SWG\Parameter(
     *          name="password",
     *          in="formData",
     *          required=true,
     *          type="string",
     *          description="User's password"
     *      ),
     *      @SWG\Response(
     *          response=201,
     *          description="Registration successful",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="message", type="string", example="Registration successful"),
     *              @SWG\Property(property="user", ref="#/definitions/User"),
     *              @SWG\Property(property="token", type="string", example="Bearer {api_token}")
     *          )
     *      ),
     *      @SWG\Response(
     *          response=422,
     *          description="Validation error",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="message", type="string", example="The given data was invalid."),
     *              @SWG\Property(property="errors", type="object")
     *          )
     *      ),
     *      @SWG\Response(
     *          response=500,
     *          description="Failed to register user",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="message", type="string", example="Failed to register user")
     *          )
     *      )
     * )
     *
     * @param Request $request
     * @param CreateNewUser $creator
     * @return JsonResponse
     */
    public function register(Request $request, CreateNewUser $creator): JsonResponse
    {
        $input = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'lion_id' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => $creator->passwordRules(),
            'terms' => ['accepted', 'required'], // If you always expect terms to be accepted
        ]);

        try {
            $user = $creator->create($input);

            // Generate API token
            if ($user instanceof HasApiTokens) {
                $token = $user->createToken('api_token')->plainTextToken;
            } else {
                $token = null;
            }

            return response()->json(['message' => 'Registration successful', 'user' => $user, 'token' => $token], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to register user'], 500);
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

