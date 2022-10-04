<?php

namespace App\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
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

    /** @var Collection<User> */
    #[ManyToMany(targetEntity: Role::class)]
    private Collection $roles;

    #[Column(type: 'boolean', options: ['default' => 'false'])]
    private bool $systemUser = false;

    public function __construct(string $email, string $password, ?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
        $this->email = $email;
        $this->password = $password;

        $this->roles = new ArrayCollection();
    }

    public function isSystemUser(): bool
    {
        return $this->systemUser;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return $this->roles
            ->map(static fn (Role $role) => $role->getSymfonyName())
            ->toArray()
        ;
    }

    public function eraseCredentials()
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}
