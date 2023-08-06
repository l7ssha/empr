<?php

declare(strict_types=1);

namespace App\Dto\Development\Developer;

class DeveloperOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public float $originalVolume,
        public float $usedVolume,
        public float $currentVolume,
    ) {
    }
}
