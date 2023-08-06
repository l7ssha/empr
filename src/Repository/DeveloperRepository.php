<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Development\Developer;
use Doctrine\Persistence\ManagerRegistry;

readonly class DeveloperRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, Developer::class);
    }
}
