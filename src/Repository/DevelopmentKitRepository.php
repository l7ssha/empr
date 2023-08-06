<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Development\DevelopmentKit;
use Doctrine\Persistence\ManagerRegistry;

readonly class DevelopmentKitRepository extends AbstractRepository
{
    public function __construct(private ManagerRegistry $manager)
    {
        parent::__construct($this->manager, DevelopmentKit::class);
    }
}
