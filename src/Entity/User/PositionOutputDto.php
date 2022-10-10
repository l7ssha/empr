<?php

namespace App\Entity\User;

use App\Dto\UserRoleOutputDto;

class PositionOutputDto
{
    public string $id;
    public string $name;
    /** @var UserRoleOutputDto[] */
    public array $roles;
}
