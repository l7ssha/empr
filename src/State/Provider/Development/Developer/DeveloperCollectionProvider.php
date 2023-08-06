<?php

declare(strict_types=1);

namespace App\State\Provider\Development\Developer;

use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\PaginatorInterface;
use ApiPlatform\State\ProviderInterface;
use App\ApiPlatform\CallbackCollectionPaginator;
use App\Dto\Development\Developer\DeveloperOutputDto;
use App\Entity\Development\Developer;
use App\Mapper\Development\DeveloperMapper;
use IteratorAggregate;

readonly class DeveloperCollectionProvider implements ProviderInterface
{
    public function __construct(
        private CollectionProvider $collectionProvider,
        private DeveloperMapper $developerMapper,
    ) {
    }

    /**
     * @param array<array-key, string> $uriVariables
     * @param array<array-key, array<array-key, mixed>> $context
     *
     * @return CallbackCollectionPaginator<Developer, DeveloperOutputDto>
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        /** @var PaginatorInterface<Developer>&IteratorAggregate<Developer> $result */
        $result = $this->collectionProvider->provide($operation, $uriVariables, $context);

        return new CallbackCollectionPaginator(
            $result,
            fn (Developer $developer) => $this->developerMapper->mapDeveloperToOutputDto($developer),
        );
    }
}
