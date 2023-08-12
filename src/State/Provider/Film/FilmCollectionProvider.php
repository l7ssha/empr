<?php

declare(strict_types=1);

namespace App\State\Provider\Film;

use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\PaginatorInterface;
use ApiPlatform\State\Pagination\PartialPaginatorInterface;
use ApiPlatform\State\ProviderInterface;
use App\ApiPlatform\CallbackCollectionPaginator;
use App\Dto\Film\FilmOutputDto;
use App\Entity\Film\Film;
use App\Mapper\Film\FilmMapper;
use IteratorAggregate;

readonly class FilmCollectionProvider implements ProviderInterface
{
    public function __construct(
        private CollectionProvider $collectionProvider,
        private FilmMapper $mapper,
    ) {
    }

    /**
     * @param array<array-key, string> $uriVariables
     * @param array<array-key, array<array-key, mixed>> $context
     *
     * @return CallbackCollectionPaginator<Film, FilmOutputDto>
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): PartialPaginatorInterface
    {
        /** @var PaginatorInterface<Film>&IteratorAggregate<Film> $result */
        $result = $this->collectionProvider->provide($operation, $uriVariables, $context);

        return new CallbackCollectionPaginator(
            $result,
            fn (Film $film) => $this->mapper->mapFilmToOutputDto($film),
        );
    }
}
