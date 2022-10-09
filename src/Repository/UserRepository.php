<?php

namespace App\Repository;

use App\Entity\User\User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

class UserRepository
{
    public function __construct(private readonly ManagerRegistry $manager)
    {
    }

    public function findByUsername(string $username): ?User
    {
        return $this->getRepository()->findOneBy(['username' => $username]);
    }

    public function findById(string $id): ?User
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        return $this->getRepository()->findAll();
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
