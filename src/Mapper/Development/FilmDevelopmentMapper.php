<?php

declare(strict_types=1);

namespace App\Mapper\Development;

use App\Dto\Development\FilmDevelopment\FilmDevelopmentOutputDto;
use App\Entity\Development\FilmDevelopment;
use App\Mapper\Film\FilmMapper;
use App\Mapper\UserMapper;

class FilmDevelopmentMapper
{
    public function __construct(
        public DevelopmentKitMapper $developmentKitMapper,
        public FilmMapper $filmMapper,
        public UserMapper $userMapper,
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
