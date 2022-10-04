<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Uid\Ulid;

#[Entity]
#[Table(name: 'products')]
#[ApiResource(
    operations: [
        new Get(security: "is_granted('ROLE_DISPLAY_PRODUCTS')"),
        new GetCollection(security: "is_granted('ROLE_DISPLAY_PRODUCTS')"),
    ]
)]
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
