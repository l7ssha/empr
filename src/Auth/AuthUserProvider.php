<?php

namespace App\Auth;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AuthUserProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new \Exception('Invalid class: '.$user::class);
        }

        $this->userRepository->save($user);
    }

    public function supportsClass(string $class)
    {
        return $class === User::class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return $this->userRepository->findByEmail($identifier) ?? throw new \Exception('missing user');
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
    }
}
