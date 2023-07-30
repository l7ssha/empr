<?php

declare(strict_types=1);

namespace App\Dto\Development\DevelopmentKit;

use Symfony\Component\Validator\Constraints as Assert;

class DevelopmentKitIdDto
{
    #[Assert\Uuid]
    public string $id;
}
