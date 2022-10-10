<?php

namespace App\Mapper;

use App\Dto\UserRoleOutputDto;
use App\Entity\User\Role;

class UserRoleDtoMapper
{
    public function mapRoleToOutputDto(Role $role): UserRoleOutputDto
    {
        $dto = new UserRoleOutputDto();

        $dto->id = $role->getId();
        $dto->name = $role->getSymfonyName();
        $dto->description = $role->getDescription();

        return $dto;
    }
}
