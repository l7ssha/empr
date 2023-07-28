<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Development\DevelopmentKit;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

readonly class DevelopmentKitRepository
{
    public function __construct(private ManagerRegistry $manager)
    {
    }

    public function findById(string $id): ?DevelopmentKit
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @return DevelopmentKit[]
     */
    public function findAll(): array
    {
        return $this->getRepository()->findAll();
    }

    public function save(DevelopmentKit $developmentKit, bool $flush = false): void
    {
        $this->manager->getManager()->persist($developmentKit);

        if ($flush) {
            $this->manager->getManager()->flush();
        }
    }

    /**
     * @return EntityRepository<DevelopmentKit>
     */
    public function getRepository(): ObjectRepository
    {
        return $this->manager->getRepository(DevelopmentKit::class);
    }
}
