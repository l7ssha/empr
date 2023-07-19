<?php

declare(strict_types=1);

namespace App\Exception;

class UserNotFoundException extends NotFoundException
{
    public static function fromUsername(string $username): self
    {
        return new self("User with username: '$username' not found");
    }
}
