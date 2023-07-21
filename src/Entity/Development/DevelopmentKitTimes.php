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
    private ?float $reversal = null;
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
}
