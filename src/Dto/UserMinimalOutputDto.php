<?php

declare(strict_types=1);

namespace App\Dto;

class UserMinimalOutputDto
{
    public function __construct(
        public string $id,
        public string $username,
    ) {
    }
}
