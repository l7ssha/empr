<?php

declare(strict_types=1);

namespace App\Mapper\Development;

use App\Dto\Development\DevelopmentKitOutputDto;
use App\Dto\Development\DevelopmentTimesOutputDto;
use App\Entity\Development\DevelopmentKit;
use App\Entity\Development\DevelopmentKitTimes;

class DevelopmentKitMapper
{
    public function mapDevelopmentKitToOutputDto(DevelopmentKit $kit): DevelopmentKitOutputDto
    {
        return new DevelopmentKitOutputDto(
            $kit->getId(),
            $kit->getName(),
            $kit->getType()->value,
            $kit->getUntrackedDevelopments() + $kit->getDevelopments()->count(), // TODO: move to service or provider of some sort
            $this->mapDevelopmentKitTimesToOutputDto($kit->getDevelopmentTimes()),
        );
    }

    public function mapDevelopmentKitTimesToOutputDto(DevelopmentKitTimes $times): DevelopmentTimesOutputDto
    {
        $dto = new DevelopmentTimesOutputDto();

        $dto->firstDeveloperTime = $times->getFirstDeveloperTime();
        $dto->firstDeveloperMultiplier = $times->getFirstDeveloperMultiplier();

        $dto->reversalTime = $times->getReversalTime();
        $dto->reversalMultiplier = $times->getReversalMultiplier();

        $dto->colorDeveloperTime = $times->getColorDeveloperTime();
        $dto->colorDeveloperMultiplier = $times->getColorDeveloperMultiplier();

        $dto->preBleachTime = $times->getPreBleachTime();
        $dto->preBleachMultiplier = $times->getPreBleachMultiplier();

        $dto->bleachTime = $times->getBleachTime();
        $dto->bleachMultiplier = $times->getBleachMultiplier();

        $dto->fixerTime = $times->getFixerTime();
        $dto->fixerMultiplier = $times->getFixerMultiplier();

        $dto->clearingTime = $times->getClearingTime();
        $dto->clearingMultiplier = $times->getClearingMultiplier();

        $dto->secondDeveloperTime = $times->getSecondDeveloperTime();
        $dto->secondDeveloperMultiplier = $times->getSecondDeveloperMultiplier();

        return $dto;
    }
}
