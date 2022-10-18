<?php

namespace App\Dto;

class PositionOutputDto
{
    public string $id;
    public string $name;
    /** @var UserRoleOutputDto[] */
    public array $roles;
}
