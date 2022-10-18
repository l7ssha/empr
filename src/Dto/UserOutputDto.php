<?php

namespace App\Dto;

class UserOutputDto
{
    public string $id;
    public string $email;
    public string $username;
    public bool $systemUser;
    /** @var array<UserRoleOutputDto> */
    public array $roles = [];
    public ?PositionOutputDto $position = null;
}
