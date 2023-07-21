<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Film\Film;
use Doctrine\Persistence\ManagerRegistry;

readonly class FilmRepository
{
    public function __construct(private ManagerRegistry $manager)
    {
    }

    public function save(Film $user, bool $flush = false): void
    {
        $this->manager->getManager()->persist($user);

        if ($flush) {
            $this->manager->getManager()->flush();
        }
    }
}