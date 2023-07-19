<?php

declare(strict_types=1);

namespace App\Dto\Film;

use App\Enum\FilmType;
use Symfony\Component\Validator\Constraints as Assert;

class FilmCreateDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 64)]
    public string $name;

    #[Assert\Type(type: FilmType::class)]
    public FilmType $type;

    #[Assert\Positive]
    public int $speed;
}
