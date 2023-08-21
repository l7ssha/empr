<?php

namespace App\State\Controller;

use App\Entity\Film\Film;
use App\Repository\FilmRepository;
use App\Storage\UserStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteFilmController extends AbstractController
{
    public function __construct(
        private readonly FilmRepository $filmRepository,
        private readonly UserStorage $userStorage,
    ) {
    }

    public function __invoke(Film $film): void
    {
        $film->setDeletedAt(new \DateTimeImmutable())
            ->setDeletedBy($this->userStorage->getCurrentUser())
        ;

        $this->filmRepository->save($film, true);
    }
}
