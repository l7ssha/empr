<?php

declare(strict_types=1);

namespace App\Entity\Development;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Dto\Development\FilmDevelopment\FilmDevelopmentCreateDto;
use App\Dto\Development\FilmDevelopment\FilmDevelopmentOutputDto;
use App\Entity\Customer;
use App\Entity\Film\Film;
use App\Entity\User\User;
use App\State\Processor\CreateFilmDevelopmentProcessor;
use App\State\Provider\Development\FilmDevelopment\FilmDevelopmentCollectionProvider;
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
#[Table(name: 'film_developments')]
#[UniqueEntity(fields: ['developmentNumber'])]
#[ApiResource(
    operations: [
        new GetCollection(provider: FilmDevelopmentCollectionProvider::class),
        new Post(security: "is_granted('ROLE_MODIFY_DEVELOPMENT_KIT')", input: FilmDevelopmentCreateDto::class, processor: CreateFilmDevelopmentProcessor::class),
    ],
    output: FilmDevelopmentOutputDto::class,
    order: ['developmentNumber' => 'DESC'],
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'developmentNumber' => 'ipartial',
        'kit.name' => 'ipartial',
        'kit.id' => 'exact',
        'film.name' => 'ipartial',
        'film.id' => 'exact',
        'user.id' => 'exact',
        'oneShotDevelopment.developer.id' => 'exact',
        'oneShotDevelopment.developer.name' => 'ipartial',
        // TODO: Add customer to filters
    ],
)]
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
    #[JoinColumn(nullable: true)]
    private ?DevelopmentKit $kit = null;

    #[OneToOne(mappedBy: 'development', cascade: ['persist', 'remove'])]
    #[JoinColumn(nullable: true)]
    private ?OneShotDevelopment $oneShotDevelopment = null;

    #[ManyToOne]
    #[JoinColumn(nullable: false)]
    private Film $film;

    #[ManyToOne]
    #[JoinColumn(nullable: false)]
    private User $createdBy;

    #[ManyToOne]
    private ?Customer $customer = null;

    #[Column(type: 'text', length: 16384, nullable: true)]
    private ?string $notes = null;

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

    public function getKit(): ?DevelopmentKit
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

    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getOneShotDevelopment(): ?OneShotDevelopment
    {
        return $this->oneShotDevelopment;
    }

    public function setOneShotDevelopment(OneShotDevelopment $oneShotDevelopment): self
    {
        $this->oneShotDevelopment = $oneShotDevelopment;
        $oneShotDevelopment->setDevelopment($this);

        return $this;
    }
}
