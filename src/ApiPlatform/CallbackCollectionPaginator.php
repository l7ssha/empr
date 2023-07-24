<?php

declare(strict_types=1);

namespace App\ApiPlatform;

use ApiPlatform\State\Pagination\PaginatorInterface;
use IteratorAggregate;

/**
 * @template TInput of object
 * @template TOutput of object
 *
 * @implements PaginatorInterface<TOutput>
 * @implements IteratorAggregate<TOutput>
 */
readonly class CallbackCollectionPaginator implements PaginatorInterface, \IteratorAggregate
{
    /**
     * @param PaginatorInterface<TInput>&\IteratorAggregate<TInput> $paginator
     * @param \Closure(TInput):TOutput $callback
     */
    public function __construct(
        private PaginatorInterface&\IteratorAggregate $paginator,
        private \Closure $callback,
    ) {
    }

    public function count(): int
    {
        return $this->paginator->count();
    }

    public function getLastPage(): float
    {
        return $this->paginator->getLastPage();
    }

    public function getTotalItems(): float
    {
        return $this->paginator->getTotalItems();
    }

    public function getCurrentPage(): float
    {
        return $this->paginator->getCurrentPage();
    }

    public function getItemsPerPage(): float
    {
        return $this->paginator->getItemsPerPage();
    }

    public function getIterator(): \Traversable
    {
        $fn = $this->callback;
        foreach ($this->paginator->getIterator() as $key => $outputItem) {
            yield $key => $fn($outputItem);
        }
    }
}
