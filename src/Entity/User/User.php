<?php

namespace App\Entity\User;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Dto\UserOutputDto;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Ulid;

#[ApiResource(
    operations: [
        new Get(security: "is_granted('ROLE_DISPLAY_USERS')"),
        new GetCollection(security: "is_granted('ROLE_DISPLAY_USERS')"),
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
    public const ADMIN_ID = '01GEFRX9VHN2DF70HNH0K6MQSG';
    public const ADMIN_EMAIL = 'admin@example.com';
    public const ADMIN_USERNAME = 'admin';

    #[Id]
    #[Column(type: 'string', length: 64)]
    private string $id;

    #[Column(type: 'string', length: 64, unique: true)]
    private string $email;

    #[Column(type: 'string', length: 32, unique: true)]
    private string $username;

    #[Column(type: 'string')]
    private string $password;

    /** @var Collection<Role> */
    #[ManyToMany(targetEntity: Role::class)]
    private Collection $roles;

    #[Column(type: 'boolean', updatable: false, options: ['default' => 'false'])]
    private bool $systemUser = false;

    #[ManyToOne(targetEntity: Position::class)]
    private ?Position $position = null;

    public function __construct(string $email, string $username, string $password, ?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->roles = new ArrayCollection();
    }

    public function getPosition(): ?Position
    {
        return $this->position;
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
        return array_map(
            static fn (Role $role) => $role->getSymfonyName(),
            array_merge(
                $this->roles->toArray(),
                $this->position?->getRoles()?->toArray() ?? []
            )
        );
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
