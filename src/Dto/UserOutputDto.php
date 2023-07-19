<?php

declare(strict_types=1);

namespace App\Dto;

class UserOutputDto
{
    public string $id;
    public string $email;
    public string $username;
    public bool $systemUser;
    /** @var array<UserRoleOutputDto> */
    public array $roles = [];
}
