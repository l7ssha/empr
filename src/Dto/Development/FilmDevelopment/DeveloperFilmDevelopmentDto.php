<?php

declare(strict_types=1);

namespace App\Dto\Development\FilmDevelopment;

use Symfony\Component\Validator\Constraints as Assert;

class DeveloperFilmDevelopmentDto
{
    #[Assert\Uuid]
    public string $id;

    #[Assert\NotBlank(allowNull: true)]
    public ?string $dilution = null;
}
