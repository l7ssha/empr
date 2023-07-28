<?php

declare(strict_types=1);

namespace App\Dto\Development\DevelopmentKit;

use App\Enum\DevelopmentType;
use App\Validator\ValidDevelopmentTimes;
use Symfony\Component\Validator\Constraints as Assert;

#[ValidDevelopmentTimes]
class DevelopmentKitCreateDto
{
    #[Assert\NotBlank]
    public string $name;

    #[Assert\Type(type: DevelopmentType::class)]
    public DevelopmentType $type;

    #[Assert\PositiveOrZero]
    public int $untrackedDevelopments;

    public DevelopmentTimesDto $developmentTimes;
}
