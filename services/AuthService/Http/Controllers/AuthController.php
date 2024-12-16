<?php

namespace Services\AuthService\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Services\AuthService\Contracts\AuthServiceInterface;
use Services\AuthService\Http\Requests\UserLoginRequest;
use Services\AuthService\Http\Requests\UserRegisterRequest;
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
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        $authUserDTO = new UserAuthDTO($request->validated());
        return app('services.auth-service')->login($authUserDTO);
    }
}
