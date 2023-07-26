<?php

declare(strict_types=1);

namespace App\State\Provider\Development\DevelopmentKit;

use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\PaginatorInterface;
use ApiPlatform\State\Pagination\PartialPaginatorInterface;
use ApiPlatform\State\ProviderInterface;
use App\ApiPlatform\CallbackCollectionPaginator;
use App\Dto\Development\DevelopmentKitOutputDto;
use App\Entity\Development\DevelopmentKit;
use App\Mapper\Development\DevelopmentKitMapper;
use IteratorAggregate;

readonly class DevelopmentKitCollectionProvider implements ProviderInterface
{
    public function __construct(
        private CollectionProvider $collectionProvider,
        private DevelopmentKitMapper $mapper,
    ) {
    }

    /**
     * @param array<array-key, string> $uriVariables
     * @param array<array-key, array<array-key, mixed>> $context
     *
     * @return CallbackCollectionPaginator<DevelopmentKit, DevelopmentKitOutputDto>
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): PartialPaginatorInterface
    {
        /** @var PaginatorInterface<DevelopmentKit>&IteratorAggregate<DevelopmentKit> $result */
        $result = $this->collectionProvider->provide($operation, $uriVariables, $context);

        return new CallbackCollectionPaginator(
            $result,
            fn (DevelopmentKit $kit) => $this->mapper->mapDevelopmentKitToOutputDto($kit),
        );
    }
}
