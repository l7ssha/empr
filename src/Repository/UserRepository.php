<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User\User;
use Doctrine\Persistence\ManagerRegistry;

readonly class UserRepository extends AbstractRepository
{
    public function __construct(private ManagerRegistry $manager)
    {
        parent::__construct($this->manager, User::class);
    }

    public function findByUsernameOrEmail(string $identifier): ?User
    {
        return $this->getRepository()->createQueryBuilder('u')
            ->where('u.username = :identifier')
            ->orWhere('u.email = :identifier')
            ->setParameter('identifier', $identifier)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
