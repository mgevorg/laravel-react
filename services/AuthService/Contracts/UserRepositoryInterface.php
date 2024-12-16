<?php

namespace Services\AuthService\Contracts;


use Services\AuthService\Http\DTOs\UserRegisterDTO;

interface UserRepositoryInterface
{
    public function findById($id);
    public function create(UserRegisterDTO $dto);
}
