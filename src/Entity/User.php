<?php

namespace App\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Ulid;

#[Entity]
#[Table(name: 'users')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const ADMIN_ID = '01GEFRX9VHN2DF70HNH0K6MQSG';
    public const ADMIN_EMAIL = 'admin@example.com';

    #[Id]
    #[Column(type: 'string', length: 64)]
    private string $id;

    #[Column(type: 'string', length: 64)]
    private string $email;

    #[Column(type: 'string')]
    private string $password;

    public function __construct(string $email, string $password, ?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
        $this->email = $email;
        $this->password = $password;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials() {}

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}
