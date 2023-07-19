<?php

declare(strict_types=1);

namespace App\Dto\Film;

class FilmOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $type,
        public int $speed,
    ) {
    }
}
