<?php

namespace App\Entity\User;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Uid\Ulid;

#[Entity]
#[Table(name: 'user_roles')]
class Role
{
    #[Id]
    #[Column(type: 'string', length: 64)]
    private string $id;

    #[Column(type: 'string', length: '64', unique: true, updatable: false)]
    private string $name;

    #[Column(type: 'string', length: '255')]
    private string $description;

    public function __construct(string $name, string $description, ?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
        $this->name = $name;
        $this->description = $description;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSymfonyName(): string
    {
        return "ROLE_$this->name";
    }
}
