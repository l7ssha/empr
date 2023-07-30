<?php

declare(strict_types=1);

namespace App\Dto\Film;

use Symfony\Component\Validator\Constraints as Assert;

class FilmIdDto
{
    #[Assert\Uuid]
    public string $id;
}
