<?php

namespace Services\AuthService\Http\DTOs;

class UserRegisterDTO extends BaseDTO
{
    public string $name;
    public string $email;
    public string $password;

    public function __construct(array $arguments)
    {
        foreach($arguments as $key => $value) {
            $this->$key = $value;
        }
    }
}
