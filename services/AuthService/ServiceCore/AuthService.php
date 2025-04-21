<?php

namespace Services\AuthService\ServiceCore;

use Illuminate\Http\JsonResponse;
use Services\AuthService\Contracts\AuthServiceInterface;
use Services\AuthService\Http\DTOs\UserAuthDTO;
use Services\AuthService\Http\DTOs\UserRegisterDTO;

use Services\AuthService\Models\AuthUser;
use Services\AuthService\Repositories\UserRepository;

class AuthService implements AuthServiceInterface
{

    public function __construct(
        private UserRepository $userRepository)
    {

    }

    public function login(UserAuthDTO $userAuthDto)
    {
        if (!$token = auth('api')->attempt($userAuthDto->toArray())) {
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

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user() : JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * Register a new User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRegisterDTO $dto) : AuthUser
    {
        $user = $this->userRepository->create($dto);
        return $user;
    }
}
