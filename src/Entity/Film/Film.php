<?php

declare(strict_types=1);

namespace App\Entity\Film;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Dto\Film\FilmCreateDto;
use App\Dto\Film\FilmOutputDto;
use App\Enum\FilmType;
use App\State\Processor\CreateFilmProcessor;
use App\State\Provider\Film\FilmCollectionProvider;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Uid\UuidV6;
use Symfony\Component\Validator\Constraints as Assert;

#[Entity]
#[Table(name: 'films')]
#[ApiResource(
    operations: [
        new GetCollection(provider: FilmCollectionProvider::class),
        new Post(security: "is_granted('ROLE_CREATE_FILMS')", input: FilmCreateDto::class, processor: CreateFilmProcessor::class),
    ],
    output: FilmOutputDto::class,
    order: ['name' => 'ASC'],
)]
#[UniqueEntity(fields: ['name'])]
#[ApiFilter(OrderFilter::class, properties: ['speed', 'name', 'type'])]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'ipartial'])]
class Film
{
    #[Id]
    #[Column(length: 36, updatable: false)]
    #[Assert\Uuid]
    private readonly string $id;

    #[Column(length: 64, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 64)]
    private string $name;

    #[Column(type: 'string', enumType: FilmType::class)]
    #[Assert\Type(type: FilmType::class)]
    private FilmType $type;

    #[Column]
    #[Assert\Positive]
    private int $speed;

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

    public function getType(): FilmType
    {
        return $this->type;
    }

    public function setType(FilmType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }
}
