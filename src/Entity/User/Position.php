<?php

namespace App\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Uid\Ulid;

#[Entity]
#[Table(name: 'user_positions')]
class Position
{
    #[Id]
    #[Column(type: 'string', length: 64)]
    private string $id;

    #[Column(type: 'string', length: 32, unique: true)]
    private string $name;

    /** @var Collection<Role> */
    #[ManyToMany(targetEntity: Role::class)]
    private Collection $roles;

    public function __construct(string $name, ?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
        $this->name = $name;
        $this->roles = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Collection<Role>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }
}
