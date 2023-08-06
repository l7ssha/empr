<?php

declare(strict_types=1);

namespace App\Dto\Development\Developer;

use Symfony\Component\Validator\Constraints as Assert;

class CreateDeveloperInputDto
{
    #[Assert\NotBlank]
    public string $name;

    #[Assert\PositiveOrZero]
    public float $originalVolume;
}
