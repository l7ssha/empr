<?php

declare(strict_types=1);

namespace App\Mapper\Development;

use App\Dto\Development\FilmDevelopment\DeveloperFilmDevelopmentOutputDto;
use App\Dto\Development\FilmDevelopment\FilmDevelopmentOutputDto;
use App\Entity\Development\FilmDevelopment;
use App\Entity\Development\OneShotDevelopment;
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
        $kit = $filmDevelopment->getKit() !== null
            ? $this->developmentKitMapper->mapDevelopmentKitToMinimalOutputDto($filmDevelopment->getKit())
            : null;

        $developer = $filmDevelopment->getOneShotDevelopment() !== null
            ? $this->mapOneShotDeveloper($filmDevelopment->getOneShotDevelopment())
            : null;

        return new FilmDevelopmentOutputDto(
            $filmDevelopment->getId(),
            $filmDevelopment->getDevelopmentNumber(),
            $this->filmMapper->mapFilmToOutputDto($filmDevelopment->getFilm()),
            $this->userMapper->mapUserToMinimalOutputDto($filmDevelopment->getCreatedBy()),
            $filmDevelopment->getNotes(),
            $kit,
            $developer,
        );
    }

    public function mapOneShotDeveloper(OneShotDevelopment $oneShotDevelopment): DeveloperFilmDevelopmentOutputDto
    {
        return new DeveloperFilmDevelopmentOutputDto(
            $oneShotDevelopment->getDeveloper()->getId(),
            $oneShotDevelopment->getDeveloper()->getName(),
            $oneShotDevelopment->getDilution(),
        );
    }
}
