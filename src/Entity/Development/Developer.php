<?php

declare(strict_types=1);

namespace App\Entity\Development;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Dto\Development\Developer\CreateDeveloperInputDto;
use App\Dto\Development\Developer\DeveloperOutputDto;
use App\State\Processor\CreateDeveloperProcessor;
use App\State\Provider\Development\Developer\DeveloperCollectionProvider;
use App\State\Provider\Development\Developer\DeveloperProvider;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Uid\UuidV6;
use Symfony\Component\Validator\Constraints as Assert;

#[Entity]
#[Table(name: 'developers')]
#[UniqueEntity(fields: ['name'])]
#[ApiResource(
    operations: [
        new Get(output: DeveloperOutputDto::class, provider: DeveloperProvider::class),
        new GetCollection(output: DeveloperOutputDto::class, provider: DeveloperCollectionProvider::class),
        new Post(input: CreateDeveloperInputDto::class, output: DeveloperOutputDto::class, processor: CreateDeveloperProcessor::class), // TODO: Add permissions
    ],
)]
class Developer
{
    #[Id]
    #[Column(length: 36, updatable: false)]
    #[Assert\Uuid]
    private readonly string $id;

    #[Column(unique: true)]
    #[Assert\NotBlank]
    private string $name;

    #[Column(scale: 2)]
    private float $originalVolume;

    #[Column(scale: 2, options: ['default' => '0'])]
    private float $usedVolume = 0;

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

    public function getOriginalVolume(): float
    {
        return $this->originalVolume;
    }

    public function setOriginalVolume(float $originalVolume): self
    {
        $this->originalVolume = $originalVolume;

        return $this;
    }

    public function getUsedVolume(): float
    {
        return $this->usedVolume;
    }

    public function setUsedVolume(float $usedVolume): self
    {
        $this->usedVolume = $usedVolume;

        return $this;
    }
}
