<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

class UserRepository
{
    public function __construct(private readonly ManagerRegistry $manager)
    {
    }

    public function findByEmail(string $email): ?User
    {
        return $this->getRepository()->findOneBy(['email' => $email]);
    }

    public function save(User $user): void
    {
        $this->manager->getManager()->persist($user);
        $this->manager->getManager()->flush();
    }

    /**
     * @return ObjectRepository<User>
     */
    public function getRepository(): ObjectRepository
    {
        return $this->manager->getRepository(User::class);
    }
}
