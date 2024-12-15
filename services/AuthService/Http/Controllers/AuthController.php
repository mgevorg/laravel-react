<?php

namespace Services\AuthService\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Services\AuthService\Contracts\AuthServiceInterface;
use Services\AuthService\Http\Requests\UserAuthRequest;
use Services\AuthService\Http\DTOs\UserAuthDTO;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param UserAuthRequest $request
     * @return JsonResponse
     */
    public function login(UserAuthRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}
