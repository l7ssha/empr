<?php

declare(strict_types=1);

namespace App\Entity\Development;

use App\Entity\Film\Film;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Uid\UuidV6;
use Symfony\Component\Validator\Constraints as Assert;

#[Entity]
#[Table(name: 'film_developments')]
#[UniqueEntity(fields: ['developmentNumber'])]
class FilmDevelopment
{
    #[Id]
    #[Column(length: 36, updatable: false)]
    #[Assert\Uuid]
    private readonly string $id;

    #[Column(unique: true)]
    #[Assert\NotBlank]
    private string $developmentNumber;

    #[ManyToOne(inversedBy: 'developments')]
    private DevelopmentKit $kit;

    #[ManyToOne]
    private Film $film;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? UuidV6::generate();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDevelopmentNumber(): string
    {
        return $this->developmentNumber;
    }

    public function setDevelopmentNumber(string $developmentNumber): self
    {
        $this->developmentNumber = $developmentNumber;

        return $this;
    }

    public function getKit(): DevelopmentKit
    {
        return $this->kit;
    }

    public function setKit(DevelopmentKit $kit): self
    {
        $this->kit = $kit;

        return $this;
    }

    public function getFilm(): Film
    {
        return $this->film;
    }

    public function setFilm(Film $film): self
    {
        $this->film = $film;

        return $this;
    }
}
