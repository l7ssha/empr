<?php

declare(strict_types=1);

namespace App\Dto\Development\DevelopmentKit;

class DevelopmentKitMinimalOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
    ) {
    }
}
