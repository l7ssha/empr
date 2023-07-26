<?php

declare(strict_types=1);

namespace App\Entity\Development;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Dto\Development\DevelopmentKitOutputDto;
use App\Enum\DevelopmentType;
use App\State\Provider\Development\DevelopmentKit\DevelopmentKitCollectionProvider;
use App\State\Provider\Development\DevelopmentKit\DevelopmentKitProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Uid\UuidV6;
use Symfony\Component\Validator\Constraints as Assert;

#[Entity]
#[Table(name: 'development_kits')]
#[ApiResource(
    operations: [
        new Get(provider: DevelopmentKitProvider::class),
        new GetCollection(provider: DevelopmentKitCollectionProvider::class),
    ],
    output: DevelopmentKitOutputDto::class,
)]
class DevelopmentKit
{
    #[Id]
    #[Column(length: 36, updatable: false)]
    #[Assert\Uuid]
    private readonly string $id;

    #[Column(length: 128, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 128)]
    private readonly string $name;

    #[Column(type: 'string', enumType: DevelopmentType::class)]
    #[Assert\Type(type: DevelopmentType::class)]
    private DevelopmentType $type;

    /** @var Collection<FilmDevelopment> */
    #[OneToMany(mappedBy: 'kit', targetEntity: FilmDevelopment::class)]
    private Collection $developments;

    #[Column(options: ['default' => '0'])]
    #[Assert\PositiveOrZero]
    private int $untrackedDevelopments = 0;

    #[Embedded(columnPrefix: 'development_times__')]
    #[Assert\Valid]
    private DevelopmentKitTimes $developmentTimes;

    public function __construct(string $name, ?string $id = null)
    {
        $this->name = $name;
        $this->id = $id ?? UuidV6::generate();

        $this->developments = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): DevelopmentType
    {
        return $this->type;
    }

    public function setType(DevelopmentType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<FilmDevelopment>
     */
    public function getDevelopments(): Collection
    {
        return $this->developments;
    }

    /**
     * @param array<FilmDevelopment> $developments
     */
    public function setDevelopments(array $developments): self
    {
        $this->developments->clear();
        foreach ($developments as $development) {
            if ($this->developments->contains($development)) {
                continue;
            }

            $this->developments->add($development);
        }

        return $this;
    }

    public function getUntrackedDevelopments(): int
    {
        return $this->untrackedDevelopments;
    }

    public function setUntrackedDevelopments(int $untrackedDevelopments): self
    {
        $this->untrackedDevelopments = $untrackedDevelopments;

        return $this;
    }

    public function incrementUntrackedDevelopments(int $toIncrement = 1): self
    {
        $this->untrackedDevelopments += $toIncrement;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDevelopmentTimes(): DevelopmentKitTimes
    {
        return $this->developmentTimes;
    }

    public function setDevelopmentTimes(DevelopmentKitTimes $developmentTimes): self
    {
        $this->developmentTimes = $developmentTimes;

        return $this;
    }
}
