<?php

declare(strict_types=1);

namespace App\Dto\Development\FilmDevelopment;

use App\Dto\Development\DevelopmentKit\DevelopmentKitIdDto;
use App\Dto\Film\FilmIdDto;
use Symfony\Component\Validator\Constraints as Assert;

class FilmDevelopmentCreateDto
{
    #[Assert\NotBlank]
    public string $developmentNumber;
    public DevelopmentKitIdDto $kit;
    public FilmIdDto $film;
    #[Assert\NotBlank(allowNull: true)]
    public ?string $notes = null;
    // TODO: customer id
}