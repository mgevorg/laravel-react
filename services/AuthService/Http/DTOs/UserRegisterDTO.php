<?php

namespace Services\AuthService\Http\DTOs;

class UserRegisterDTO extends BaseDTO
{
    public readonly string $name;
    public readonly string $email;
    public readonly string $password;

    public function __construct(array $arguments)
    {
        foreach($arguments as $key => $value) {
            $this->$key = $value;
        }
    }
}
