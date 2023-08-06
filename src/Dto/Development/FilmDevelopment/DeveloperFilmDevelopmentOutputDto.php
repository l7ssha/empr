<?php

declare(strict_types=1);

namespace App\Dto\Development\FilmDevelopment;

class DeveloperFilmDevelopmentOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $dilution,
    ) {
    }
}
