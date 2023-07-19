<?php

declare(strict_types=1);

namespace App\ApiPlatform;

use ApiPlatform\State\Pagination\PartialPaginatorInterface;

class PartialPaginatedCollection
{
    public int $page;

    public int $itemsPerPage;

    /**
     * @param array<int|string, array|bool|float|int|string|mixed|object|null> $results
     * @param PartialPaginatorInterface<object> $paginator
     */
    public function __construct(
        public array $results,
        PartialPaginatorInterface $paginator,
    ) {
        $this->itemsPerPage = (int) $paginator->getItemsPerPage();
        $this->page = (int) $paginator->getCurrentPage();
    }
}
