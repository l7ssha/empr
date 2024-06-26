<?php

declare(strict_types=1);

namespace App\Dto\Development\DevelopmentKit;

class DevelopmentKitOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $type,
        public int $developmentsCount,
        public DevelopmentTimesDto $times,
    ) {
    }
}
