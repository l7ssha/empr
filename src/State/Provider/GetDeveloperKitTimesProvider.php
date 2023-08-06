<?php

declare(strict_types=1);

namespace App\State\Provider;

use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\Development\FilmDevelopment\FilmDevelopmentTimesOutputDto;
use App\Entity\Development\DevelopmentKit;
use App\Enum\DevelopmentType;
use App\Service\DevelopmentCalculator;
use Exception;
use RuntimeException;

readonly class GetDeveloperKitTimesProvider implements ProviderInterface
{
    public function __construct(
        private ItemProvider $itemProvider,
        private DevelopmentCalculator $developmentTimesCalculator,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        /** @var DevelopmentKit|null $entity */
        $entity = $this->itemProvider->provide($operation, $uriVariables, $context);
        if ($entity === null) {
            return null;
        }

        return match ($entity->getType()) {
            DevelopmentType::BW_NEGATIVE => $this->calculateBwNegative($entity),
            DevelopmentType::BW_POSITIVE => throw new Exception('To be implemented'),
            DevelopmentType::COLOR_NEGATIVE_2STEP => throw new Exception('To be implemented'),
            DevelopmentType::COLOR_NEGATIVE_3STEP => throw new Exception('To be implemented'),
            DevelopmentType::COLOR_POSITIVE_3STEP => throw new Exception('To be implemented'),
            DevelopmentType::COLOR_POSITIVE_6STEP => throw new Exception('To be implemented'),
            default => throw new RuntimeException(), // TODO: Proper exception
        };
    }

    private function calculateBwNegative(DevelopmentKit $kit): FilmDevelopmentTimesOutputDto
    {
        $dto = new FilmDevelopmentTimesOutputDto();

        $times = $kit->getDevelopmentTimes();

        $dto->firstDeveloperTime = $this->developmentTimesCalculator->calculateDevelopmentTime(
            $times->getFirstDeveloperTime(),
            $this->developmentTimesCalculator->getTotalDevelopmentCount($kit),
            $times->getFirstDeveloperMultiplier(),
        );

        $dto->fixerTime = $this->developmentTimesCalculator->calculateDevelopmentTime(
            $times->getFixerTime(),
            $this->developmentTimesCalculator->getTotalDevelopmentCount($kit),
            $times->getFixerMultiplier(),
        );

        return $dto;
    }
}
