<?php

declare(strict_types=1);

namespace App\Entity\User;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Uid\UuidV6;
use Symfony\Component\Validator\Constraints as Assert;

#[Entity]
#[Table(name: 'user_roles')]
class Role
{
    #[Id]
    #[Column(length: 36, updatable: false)]
    #[Assert\Uuid]
    private readonly string $id;

    #[Column(length: 64, unique: true, updatable: false)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 64)]
    private readonly string $name;

    #[Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private string $description;

    public function __construct(string $name, string $description, string $id = null)
    {
        $this->id = $id ?? UuidV6::generate();
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
}
