<?php

declare(strict_types=1);

namespace App\Mapper\Development;

use App\Dto\Development\Developer\DeveloperOutputDto;
use App\Entity\Development\Developer;

class DeveloperMapper
{
    public function mapDeveloperToOutputDto(Developer $developer): DeveloperOutputDto
    {
        return new DeveloperOutputDto(
            $developer->getId(),
            $developer->getName(),
            $developer->getOriginalVolume(),
            $developer->getUsedVolume(),
            $developer->getOriginalVolume() - $developer->getUsedVolume(), // TODO: Move to service
        );
    }
}
