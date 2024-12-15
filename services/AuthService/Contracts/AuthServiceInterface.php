<?php

namespace Services\AuthService\Contracts;

use Services\AuthService\Http\DTOs\UserAuthDTO;

interface AuthServiceInterface
{
    public function login(UserAuthDTO $userAuthDto);
}
