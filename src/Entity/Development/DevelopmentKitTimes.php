<?php

declare(strict_types=1);

namespace App\Entity\Development;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use Symfony\Component\Validator\Constraints as Assert;

#[Embeddable]
class DevelopmentKitTimes
{
    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $firstDeveloperTime = null;
    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $firstDeveloperMultiplier = null;

    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $reversalTime = null;
    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $reversalMultiplier = null;

    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $colorDeveloperTime = null;
    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $colorDeveloperMultiplier = null;

    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $preBleachTime = null;
    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $preBleachMultiplier = null;

    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $bleachTime = null;
    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $bleachMultiplier = null;

    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $fixerTime = null;
    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $fixerMultiplier = null;

    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $clearingTime = null;
    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $clearingMultiplier = null;

    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $secondDeveloperTime = null;
    #[Assert\PositiveOrZero]
    #[Column(scale: 2)]
    private ?float $secondDeveloperMultiplier = null;

    public function getFirstDeveloperTime(): ?float
    {
        return $this->firstDeveloperTime;
    }

    public function setFirstDeveloperTime(?float $firstDeveloperTime): self
    {
        $this->firstDeveloperTime = $firstDeveloperTime;

        return $this;
    }

    public function getFirstDeveloperMultiplier(): ?float
    {
        return $this->firstDeveloperMultiplier;
    }

    public function setFirstDeveloperMultiplier(?float $firstDeveloperMultiplier): self
    {
        $this->firstDeveloperMultiplier = $firstDeveloperMultiplier;

        return $this;
    }

    public function getReversalTime(): ?float
    {
        return $this->reversalTime;
    }

    public function setReversalTime(?float $reversalTime): self
    {
        $this->reversalTime = $reversalTime;

        return $this;
    }

    public function getReversalMultiplier(): ?float
    {
        return $this->reversalMultiplier;
    }

    public function setReversalMultiplier(?float $reversalMultiplier): self
    {
        $this->reversalMultiplier = $reversalMultiplier;

        return $this;
    }

    public function getColorDeveloperTime(): ?float
    {
        return $this->colorDeveloperTime;
    }

    public function setColorDeveloperTime(?float $colorDeveloperTime): self
    {
        $this->colorDeveloperTime = $colorDeveloperTime;

        return $this;
    }

    public function getColorDeveloperMultiplier(): ?float
    {
        return $this->colorDeveloperMultiplier;
    }

    public function setColorDeveloperMultiplier(?float $colorDeveloperMultiplier): self
    {
        $this->colorDeveloperMultiplier = $colorDeveloperMultiplier;

        return $this;
    }

    public function getPreBleachTime(): ?float
    {
        return $this->preBleachTime;
    }

    public function setPreBleachTime(?float $preBleachTime): self
    {
        $this->preBleachTime = $preBleachTime;

        return $this;
    }

    public function getPreBleachMultiplier(): ?float
    {
        return $this->preBleachMultiplier;
    }

    public function setPreBleachMultiplier(?float $preBleachMultiplier): self
    {
        $this->preBleachMultiplier = $preBleachMultiplier;

        return $this;
    }

    public function getBleachTime(): ?float
    {
        return $this->bleachTime;
    }

    public function setBleachTime(?float $bleachTime): self
    {
        $this->bleachTime = $bleachTime;

        return $this;
    }

    public function getBleachMultiplier(): ?float
    {
        return $this->bleachMultiplier;
    }

    public function setBleachMultiplier(?float $bleachMultiplier): self
    {
        $this->bleachMultiplier = $bleachMultiplier;

        return $this;
    }

    public function getFixerTime(): ?float
    {
        return $this->fixerTime;
    }

    public function setFixerTime(?float $fixerTime): self
    {
        $this->fixerTime = $fixerTime;

        return $this;
    }

    public function getFixerMultiplier(): ?float
    {
        return $this->fixerMultiplier;
    }

    public function setFixerMultiplier(?float $fixerMultiplier): self
    {
        $this->fixerMultiplier = $fixerMultiplier;

        return $this;
    }

    public function getClearingTime(): ?float
    {
        return $this->clearingTime;
    }

    public function setClearingTime(?float $clearingTime): self
    {
        $this->clearingTime = $clearingTime;

        return $this;
    }

    public function getClearingMultiplier(): ?float
    {
        return $this->clearingMultiplier;
    }

    public function setClearingMultiplier(?float $clearingMultiplier): self
    {
        $this->clearingMultiplier = $clearingMultiplier;

        return $this;
    }

    public function getSecondDeveloperTime(): ?float
    {
        return $this->secondDeveloperTime;
    }

    public function setSecondDeveloperTime(?float $secondDeveloperTime): self
    {
        $this->secondDeveloperTime = $secondDeveloperTime;

        return $this;
    }

    public function getSecondDeveloperMultiplier(): ?float
    {
        return $this->secondDeveloperMultiplier;
    }

    public function setSecondDeveloperMultiplier(?float $secondDeveloperMultiplier): self
    {
        $this->secondDeveloperMultiplier = $secondDeveloperMultiplier;

        return $this;
    }
}
