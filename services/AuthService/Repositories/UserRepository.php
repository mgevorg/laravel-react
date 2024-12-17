<?php

namespace Services\AuthService\Repositories;

use Services\AuthService\Contracts\UserRepositoryInterface;
use Services\AuthService\Http\DTOs\UserRegisterDTO;
use Services\AuthService\Models\AuthUser;

class UserRepository implements UserRepositoryInterface
{

    public function findById($id)
    {
        //
    }

    public function create(UserRegisterDTO $dto) : AuthUser
    {
        $user = AuthUser::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
        ]);
        return $user;
    }
}
