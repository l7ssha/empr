<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Development\FilmDevelopment;
use Doctrine\Persistence\ManagerRegistry;

readonly class FilmDevelopmentRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, FilmDevelopment::class);
    }
}
