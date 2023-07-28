<?php

declare(strict_types=1);

namespace App\Dto\Development\FilmDevelopment;

use App\Dto\Development\DevelopmentKit\DevelopmentKitMinimalOutputDto;
use App\Dto\Film\FilmOutputDto;
use App\Dto\UserMinimalOutputDto;

class FilmDevelopmentOutputDto
{
    public function __construct(
        public string $id,
        public string $developmentNumber,
        public DevelopmentKitMinimalOutputDto $developmentKit,
        public FilmOutputDto $film,
        public UserMinimalOutputDto $createdBy,
        public string $notes,
        // TODO: implement customer output
    ) {
    }
}
