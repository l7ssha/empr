<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Uid\UuidV6;
use Symfony\Component\Validator\Constraints as Assert;

#[Entity]
#[Table(name: 'customers')]
class Customer
{
    #[Id]
    #[Column(length: 36, updatable: false)]
    #[Assert\Uuid]
    private readonly string $id;

    #[Column(length: 64, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 64)]
    private string $name;

    #[Column(length: 64, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(exactly: 9)]
    private string $phone;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? UuidV6::generate();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
