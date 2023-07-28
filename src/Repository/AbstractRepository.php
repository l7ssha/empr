<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

/**
 * @template T of object
 */
readonly class AbstractRepository
{
    public function __construct(private ManagerRegistry $manager, protected string $objectClass)
    {
    }

    /**
     * @return T|null
     */
    public function findById(string $id): ?object
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @param T $entity
     */
    public function save(object $entity, bool $flush = false): void
    {
        $this->manager->getManager()->persist($entity);

        if ($flush) {
            $this->manager->getManager()->flush();
        }
    }

    /**
     * @return EntityRepository<T>
     */
    public function getRepository(): ObjectRepository
    {
        return $this->manager->getRepository($this->objectClass);
    }
}
