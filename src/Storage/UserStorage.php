<?php

declare(strict_types=1);

namespace App\Storage;

use App\Entity\User\User;
use App\Repository\UserRepository;
use RuntimeException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

readonly class UserStorage
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private UserRepository $userRepository,
    ) {
    }

    public function getCurrentUser(): User
    {
        $currentUserIdentifier = $this->tokenStorage->getToken()?->getUserIdentifier();

        if ($currentUserIdentifier === null) {
            throw new RuntimeException(); // TODO: fix to better exception
        }

        return $this->userRepository->findByUsernameOrEmail($currentUserIdentifier);
    }
}
