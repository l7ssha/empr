<?php

declare(strict_types=1);

namespace App\State\Provider;

use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\User\User;
use App\Mapper\UserDtoMapper;

class UserItemProvider implements ProviderInterface
{
    public function __construct(
        private readonly ItemProvider $itemProvider,
        private readonly UserDtoMapper $userDtoMapper,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        /** @var User|null $user */
        $user = $this->itemProvider->provide($operation, $uriVariables, $context);
        if ($user === null) {
            return null;
        }

        return $this->userDtoMapper->mapUserToOutputDto($user);
    }
}
