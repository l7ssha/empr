<?php

declare(strict_types=1);

namespace App\Mapper\Film;

use App\Dto\Film\FilmOutputDto;
use App\Entity\Film\Film;

class FilmMapper
{
    public function mapFilmToOutputDto(Film $film): FilmOutputDto
    {
        return new FilmOutputDto(
            $film->getId(),
            $film->getName(),
            $film->getType()->value,
            $film->getSpeed()
        );
    }
}
