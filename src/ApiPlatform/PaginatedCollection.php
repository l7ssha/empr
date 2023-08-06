<?php

declare(strict_types=1);

namespace App\ApiPlatform;

use ApiPlatform\State\Pagination\PaginatorInterface;

class PaginatedCollection
{
    public int $page;

    public int $itemsPerPage;

    public int $totalPages;

    public int $total;

    /**
     * @param array<int|string, array|bool|float|int|string|object|mixed|null> $results
     * @param PaginatorInterface<object> $paginator
     */
    public function __construct(
        public array $results,
        PaginatorInterface $paginator,
    ) {
        $this->itemsPerPage = (int) $paginator->getItemsPerPage();
        $this->page = (int) $paginator->getCurrentPage();
        $this->total = (int) $paginator->getTotalItems();
        $this->totalPages = (int) ($this->itemsPerPage > 0 ? ceil($this->total / $this->itemsPerPage) : 1);
    }
}
