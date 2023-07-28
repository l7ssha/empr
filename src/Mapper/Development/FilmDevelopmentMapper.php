<?php

declare(strict_types=1);

namespace App\Mapper\Development;

use App\Dto\Development\FilmDevelopment\FilmDevelopmentOutputDto;
use App\Entity\Development\FilmDevelopment;
use App\Mapper\Film\FilmMapper;
use App\Mapper\UserMapper;

readonly class FilmDevelopmentMapper
{
    public function __construct(
        private DevelopmentKitMapper $developmentKitMapper,
        private FilmMapper $filmMapper,
        private UserMapper $userMapper,
    ) {
    }

    public function mapFilmDevelopmentToOutputDto(FilmDevelopment $filmDevelopment): FilmDevelopmentOutputDto
    {
        return new FilmDevelopmentOutputDto(
            $filmDevelopment->getId(),
            $filmDevelopment->getDevelopmentNumber(),
            $this->developmentKitMapper->mapDevelopmentKitToMinimalOutputDto($filmDevelopment->getKit()),
            $this->filmMapper->mapFilmToOutputDto($filmDevelopment->getFilm()),
            $this->userMapper->mapUserToMinimalOutputDto($filmDevelopment->getCreatedBy()),
            $filmDevelopment->getNotes(),
        );
    }
}
