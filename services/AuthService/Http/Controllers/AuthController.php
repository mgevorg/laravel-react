<?php

namespace Services\AuthService\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Services\AuthService\Contracts\AuthServiceInterface;
use Services\AuthService\Http\DTOs\UserRegisterDTO;
use Services\AuthService\Http\Requests\UserLoginRequest;
use Services\AuthService\Http\Requests\UserRegisterRequest;
use Services\AuthService\Http\DTOs\UserAuthDTO;
use Illuminate\Support\Facades\Auth;
use Services\AuthService\Models\AuthUser;

class AuthController extends Controller
{
    public function __construct()
    {
        
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        $authUserDTO = new UserAuthDTO($request->validated());
        return app('services.auth-service')->login($authUserDTO);
    }

    /**
     *
     *
     */
    public function user()
    {
        return app('services.auth-service')->user();
    }

    /**
     * Register a new user.
     *
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request)
    {
        $registerUserDTO = new UserRegisterDTO($request->validated());
        $user = app('services.auth-service')->register($registerUserDTO);
        if ($user) {
            $authUserDTO = new UserAuthDTO($request->only('email', 'password'));
            return app('services.auth-service')->login($authUserDTO);
        }
    }
}
