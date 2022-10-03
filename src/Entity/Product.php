<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Uid\Ulid;

#[Entity]
#[Table(name: 'products')]
#[ApiResource]
class Product
{
    #[Id]
    #[Column(type: 'string')]
    private string $id;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
    }

    public function getId(): string
    {
        return $this->id;
    }
}
