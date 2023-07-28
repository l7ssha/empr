<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Dto\UserMinimalOutputDto;
use App\Dto\UserOutputDto;
use App\Entity\User\Role;
use App\Entity\User\User;

class UserMapper
{
    public function __construct(
        private readonly UserRoleDtoMapper $userRoleMapper,
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
            fn (Role $role) => $this->userRoleMapper->mapRoleToOutputDto($role),
        )->toArray();

        return $dto;
    }

    public function mapUserToMinimalOutputDto(User $user): UserMinimalOutputDto
    {
        return new UserMinimalOutputDto(
            $user->getId(),
            $user->getUsername(),
        );
    }
}
