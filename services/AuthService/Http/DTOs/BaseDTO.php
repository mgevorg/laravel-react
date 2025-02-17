<?php

namespace Services\AuthService\Http\DTOs;

class BaseDTO
{
    public function toArray()
    {
        $dataArray = [];
        foreach(get_object_vars($this) as $key => $value) {
            $dataArray[$key] = $value;
        }
        return $dataArray;
    }
}
