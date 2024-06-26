<?php

declare(strict_types=1);

namespace App\Security;

use App\Entity\User\User;
use App\Exception\UserNotFoundException;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

readonly class AuthUserProvider implements UserProviderInterface
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->userRepository->findByUsernameOrEmail($user->getUserIdentifier());
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
        return $this->userRepository->findByUsernameOrEmail($identifier) ?? throw UserNotFoundException::fromUsername($identifier);
    }
}
