<?php

namespace App\Mapper;

use App\Dto\UserOutputDto;
use App\Entity\User\Role;
use App\Entity\User\User;

class UserDtoMapper
{
    public function __construct(
        private readonly UserRoleDtoMapper $userRoleMapper,
        private readonly PositionDtoMapper $positionDtoMapper
    ) {
    }

    public function mapUserToOutputDto(User $user): UserOutputDto
    {
        $dto = new UserOutputDto();

        $dto->id = $user->getId();
        $dto->username = $user->getUsername();
        $dto->email = $user->getEmail();
        $dto->systemUser = $user->isSystemUser();
        $dto->roles = $user->getRoleObjects()->map(
            fn (Role $role) => $this->userRoleMapper->mapRoleToOutputDto($role)
        )->toArray();
        $dto->position = $user->getPosition()
            ? $this->positionDtoMapper->mapPositionToOutputDto($user->getPosition())
            : null;

        return $dto;
    }
}
