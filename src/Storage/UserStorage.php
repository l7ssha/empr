<?php

declare(strict_types=1);

namespace App\Storage;

use App\Entity\User\User;
use App\Exception\CurrentUserMissingException;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

readonly class UserStorage
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private UserRepository $userRepository,
    ) {
    }

    /**
     * @throws CurrentUserMissingException
     */
    public function getCurrentUser(): User
    {
        $currentUserIdentifier = $this->tokenStorage->getToken()?->getUserIdentifier();

        if ($currentUserIdentifier === null) {
            throw new CurrentUserMissingException();
        }

        return $this->userRepository->findByUsernameOrEmail($currentUserIdentifier);
    }
}
