<?php

declare(strict_types=1);

namespace App\Entity\User;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Dto\UserOutputDto;
use App\State\Provider\UserCollectionProvider;
use App\State\Provider\UserItemProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\UuidV6;

#[ApiResource(
    operations: [
        new Get(security: "is_granted('ROLE_DISPLAY_USERS')", provider: UserItemProvider::class),
        new GetCollection(security: "is_granted('ROLE_DISPLAY_USERS')", provider: UserCollectionProvider::class),
    ],
    output: UserOutputDto::class
)]
#[Entity]
#[Table(name: 'users')]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'email' => 'ipartial',
        'username' => 'ipartial',
        'roles.name' => 'ipartial',
    ]
)]
#[ApiFilter(
    BooleanFilter::class,
    properties: [
        'systemUser',
    ]
)]
#[Index(columns: ['username'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const ADMIN_ID = 'c71d6654-f564-4b1d-975d-cd7242e5455a';
    public const ADMIN_EMAIL = 'admin@example.com';
    public const ADMIN_USERNAME = 'admin';

    #[Id]
    #[Column(length: 36, updatable: false)]
    private readonly string $id;

    #[Column(updatable: false, options: ['default' => 'false'])]
    private bool $systemUser = false;

    #[Column(length: 64, unique: true)]
    private string $email;

    #[Column(length: 32, unique: true)]
    private string $username;

    #[Column]
    private string $password;

    /** @var Collection<Role> */
    #[ManyToMany(targetEntity: Role::class)]
    private Collection $roles;

    public function __construct(string $email, string $username, string $password, string $id = null)
    {
        $this->id = $id ?? UuidV6::generate();
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->roles = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function isSystemUser(): bool
    {
        return $this->systemUser;
    }

    /**
     * @return Collection<Role>
     */
    public function getRoleObjects(): Collection
    {
        return $this->roles;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return $this
            ->getRoleObjects()
            ->map(static fn (Role $role) => $role->getName())
            ->toArray()
        ;
    }

    public function eraseCredentials()
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}
