<?php

declare(strict_types=1);

namespace App\Entity\Development;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Uid\UuidV6;
use Symfony\Component\Validator\Constraints as Assert;

#[Entity]
#[Table(name: 'one_shot_developments')]
#[UniqueEntity(fields: ['development'])]
class OneShotDevelopment
{
    #[Id]
    #[Column(length: 36, updatable: false)]
    #[Assert\Uuid]
    private readonly string $id;

    #[ManyToOne]
    #[JoinColumn(nullable: false)]
    private Developer $developer;

    #[OneToOne(inversedBy: 'oneShotDevelopment')]
    #[JoinColumn(unique: true, nullable: false)]
    private FilmDevelopment $development;

    #[Column(nullable: true)]
    private ?string $dilution = null;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? UuidV6::generate();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDeveloper(): Developer
    {
        return $this->developer;
    }

    public function setDeveloper(Developer $developer): self
    {
        $this->developer = $developer;

        return $this;
    }

    public function getDevelopment(): FilmDevelopment
    {
        return $this->development;
    }

    public function setDevelopment(FilmDevelopment $development): self
    {
        $this->development = $development;

        return $this;
    }

    public function getDilution(): ?string
    {
        return $this->dilution;
    }

    public function setDilution(?string $dilution): self
    {
        $this->dilution = $dilution;

        return $this;
    }
}
