<?php

namespace App\Mapper;

use App\Entity\User\Position;
use App\Entity\User\PositionOutputDto;
use App\Entity\User\Role;

class PositionDtoMapper
{
    public function __construct(
        private readonly UserRoleDtoMapper $userRoleMapper
    ) {
    }

    public function mapPositionToOutputDto(Position $position): PositionOutputDto
    {
        $dto = new PositionOutputDto();

        $dto->id = $position->getId();
        $dto->name = $position->getName();
        $dto->roles = $position->getRoles()->map(
            fn (Role $role) => $this->userRoleMapper->mapRoleToOutputDto($role)
        )->toArray();

        return $dto;
    }
}
