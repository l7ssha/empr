<?php

namespace App\Security;

use App\Entity\User\User;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AuthUserProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function refreshUser(UserInterface $user): User
    {
        if (!$user instanceof User) {
            throw new Exception('Invalid class: '.$user::class);
        }

        $this->userRepository->save($user);

        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return $class === User::class;
    }

    /**
     * @throws Exception
     */
    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return $this->userRepository->findByUsername($identifier) ?? throw new Exception('missing user');
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
    }
}
