<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\User\User;
use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToOne;

trait SoftDeleteTrait
{
    #[Column(type: 'datetimetz_immutable', nullable: true)]
    private ?DateTimeImmutable $deletedAt = null;

    #[ManyToOne]
    private ?User $deletedBy = null;

    public function getDeletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?DateTimeImmutable $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getDeletedBy(): ?User
    {
        return $this->deletedBy;
    }

    public function setDeletedBy(?User $deletedBy): self
    {
        $this->deletedBy = $deletedBy;
        return $this;
    }
}
