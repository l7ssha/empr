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
    /**
     * @param class-string<T> $objectClass
     */
    public function __construct(private ManagerRegistry $manager, protected string $objectClass)
    {
    }

    /**
     * @return T[]
     */
    public function findAll(): array
    {
        return $this->getRepository()->findAll();
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
     * @param T $entity
     */
    public function remove(object $entity, bool $flush = false): void
    {
        $this->manager->getManager()->remove($entity);

        if ($flush) {
            $this->manager->getManager()->flush();
        }
    }

    /**
     * @return EntityRepository<T>
     */
    protected function getRepository(): ObjectRepository
    {
        return $this->manager->getRepository($this->objectClass);
    }
}
