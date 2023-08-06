<?php

declare(strict_types=1);

namespace App\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Validator\ValidatorInterface;
use App\Dto\Development\FilmDevelopment\FilmDevelopmentCreateDto;
use App\Dto\Development\FilmDevelopment\FilmDevelopmentOutputDto;
use App\Entity\Development\FilmDevelopment;
use App\Entity\Development\OneShotDevelopment;
use App\Mapper\Development\FilmDevelopmentMapper;
use App\Repository\DeveloperRepository;
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
        private DeveloperRepository $developerRepository,
    ) {
    }

    /**
     * @param FilmDevelopmentCreateDto $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): FilmDevelopmentOutputDto
    {
        $film = $this->filmRepository->findById($data->film->id);

        $filmDevelopment = new FilmDevelopment();
        $filmDevelopment
            ->setFilm($film)
            ->setNotes($data->notes)
            ->setDevelopmentNumber($data->developmentNumber)
            ->setCreatedBy($this->userStorage->getCurrentUser())
        ;

        if ($data->kit !== null) {
            $kit = $this->developmentKitRepository->findById($data->kit->id);
            $filmDevelopment->setKit($kit);
        } elseif ($data->developer !== null) {
            $developer = $this->developerRepository->findById($data->developer->id);

            $oneShotDevelopment = (new OneShotDevelopment())
                ->setDeveloper($developer)
                ->setDilution($data->developer->dilution)
            ;

            $filmDevelopment->setOneShotDevelopment($oneShotDevelopment);
        }

        $this->validator->validate($filmDevelopment);
        $this->filmDevelopmentRepository->save($filmDevelopment, true);

        return $this->filmDevelopmentMapper->mapFilmDevelopmentToOutputDto($filmDevelopment);
    }
}
