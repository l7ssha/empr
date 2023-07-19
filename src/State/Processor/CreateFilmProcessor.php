<?php

declare(strict_types=1);

namespace App\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Dto\Film\FilmCreateDto;
use App\Dto\Film\FilmOutputDto;
use App\Entity\Film\Film;
use App\Mapper\Film\FilmMapper;
use App\Repository\FilmRepository;

readonly class CreateFilmProcessor implements ProcessorInterface
{
    public function __construct(
        private FilmRepository $filmRepository,
        private FilmMapper $filmMapper,
    ) {
    }

    /**
     * @param FilmCreateDto $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): FilmOutputDto
    {
        $film = new Film();
        $film->setName($data->name)
            ->setType($data->type)
            ->setSpeed($data->speed)
        ;

        $this->filmRepository->save($film, true);

        return $this->filmMapper->mapFilmToOutputDto($film);
    }
}
