<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Dto\UserRoleOutputDto;
use App\Entity\User\Role;

class UserRoleDtoMapper
{
    public function mapRoleToOutputDto(Role $role): UserRoleOutputDto
    {
        $dto = new UserRoleOutputDto();

        $dto->id = $role->getId();
        $dto->name = $role->getName();
        $dto->description = $role->getDescription();

        return $dto;
    }
}
