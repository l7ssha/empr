<?php

declare(strict_types=1);

namespace App\State\Provider;

use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\PaginatorInterface;
use ApiPlatform\State\Pagination\PartialPaginatorInterface;
use ApiPlatform\State\ProviderInterface;
use App\ApiPlatform\CallbackCollectionPaginator;
use App\Dto\UserOutputDto;
use App\Entity\User\User;
use App\Mapper\UserDtoMapper;

class UserCollectionProvider implements ProviderInterface
{
    public function __construct(
        private readonly CollectionProvider $collectionProvider,
        private readonly UserDtoMapper $userDtoMapper,
    ) {
    }

    /**
     * @param array<array-key, string> $uriVariables
     * @param array<array-key, array<array-key, mixed>> $context
     *
     * @return CallbackCollectionPaginator<User, UserOutputDto>
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): PartialPaginatorInterface
    {
        /** @var PaginatorInterface<User>&\IteratorAggregate<User> $result */
        $result = $this->collectionProvider->provide($operation, $uriVariables, $context);

        return new CallbackCollectionPaginator(
            $result,
            fn (User $productionOrder) => $this->userDtoMapper->mapUserToOutputDto($productionOrder),
        );
    }
}
