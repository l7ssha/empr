<?php

namespace App\Exception;

class UserNotFoundException extends NotFoundException
{
    public static function fromUserUsername(string $username): self
    {
        return new self("User with username: '$username' not found");
    }
}
