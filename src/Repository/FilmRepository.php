<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Film\Film;
use Doctrine\Persistence\ManagerRegistry;

readonly class FilmRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, Film::class);
    }
}
