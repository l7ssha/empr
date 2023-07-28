<?php

declare(strict_types=1);

namespace App\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Validator\ValidatorInterface;
use App\Dto\Development\FilmDevelopment\FilmDevelopmentCreateDto;
use App\Dto\Development\FilmDevelopment\FilmDevelopmentOutputDto;
use App\Entity\Development\FilmDevelopment;
use App\Mapper\Development\FilmDevelopmentMapper;
use App\Repository\DevelopmentKitRepository;
use App\Repository\FilmDevelopmentRepository;
use App\Repository\FilmRepository;
use App\Storage\UserStorage;

readonly class CreateFilmDevelopmentProcessor implements ProcessorInterface
{
    public function __construct(
        private FilmDevelopmentRepository $filmDevelopmentRepository,
        private FilmDevelopmentMapper $filmDevelopmentMapper,
        private ValidatorInterface $validator,
        private DevelopmentKitRepository $developmentKitRepository,
        private FilmRepository $filmRepository,
        private UserStorage $userStorage,
    ) {
    }

    /**
     * @param FilmDevelopmentCreateDto $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): FilmDevelopmentOutputDto
    {
        $kit = $this->developmentKitRepository->findById($data->kit->id);
        $film = $this->filmRepository->findById($data->film->id);

        $filmDevelopment = new FilmDevelopment();
        $filmDevelopment
            ->setFilm($film)
            ->setKit($kit)
            ->setNotes($data->notes)
            ->setDevelopmentNumber($data->developmentNumber)
            ->setCreatedBy($this->userStorage->getCurrentUser())
        ;

        $this->validator->validate($filmDevelopment);
        $this->filmDevelopmentRepository->save($filmDevelopment, true);

        return $this->filmDevelopmentMapper->mapFilmDevelopmentToOutputDto($filmDevelopment);
    }
}
