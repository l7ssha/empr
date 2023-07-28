<?php

declare(strict_types=1);

namespace App\State\Provider\Development\FilmDevelopment;

use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\PaginatorInterface;
use ApiPlatform\State\Pagination\PartialPaginatorInterface;
use ApiPlatform\State\ProviderInterface;
use App\ApiPlatform\CallbackCollectionPaginator;
use App\Dto\Development\FilmDevelopment\FilmDevelopmentOutputDto;
use App\Entity\Development\FilmDevelopment;
use App\Mapper\Development\FilmDevelopmentMapper;
use IteratorAggregate;

readonly class FilmDevelopmentCollectionProvider implements ProviderInterface
{
    public function __construct(
        private CollectionProvider $collectionProvider,
        private FilmDevelopmentMapper $mapper,
    ) {
    }

    /**
     * @param array<array-key, string> $uriVariables
     * @param array<array-key, array<array-key, mixed>> $context
     *
     * @return CallbackCollectionPaginator<FilmDevelopment, FilmDevelopmentOutputDto>
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): PartialPaginatorInterface
    {
        /** @var PaginatorInterface<FilmDevelopment>&IteratorAggregate<FilmDevelopment> $result */
        $result = $this->collectionProvider->provide($operation, $uriVariables, $context);

        return new CallbackCollectionPaginator(
            $result,
            fn (FilmDevelopment $kit) => $this->mapper->mapFilmDevelopmentToOutputDto($kit),
        );
    }
}
