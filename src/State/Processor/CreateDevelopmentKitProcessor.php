<?php

declare(strict_types=1);

namespace App\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Validator\ValidatorInterface;
use App\Dto\Development\DevelopmentKit\DevelopmentKitCreateDto;
use App\Dto\Development\DevelopmentKit\DevelopmentKitOutputDto;
use App\Dto\Development\DevelopmentKit\DevelopmentTimesDto;
use App\Entity\Development\DevelopmentKit;
use App\Entity\Development\DevelopmentKitTimes;
use App\Mapper\Development\DevelopmentKitMapper;
use App\Repository\DevelopmentKitRepository;

readonly class CreateDevelopmentKitProcessor implements ProcessorInterface
{
    public function __construct(
        private DevelopmentKitRepository $developmentKitRepository,
        private DevelopmentKitMapper $developmentKitMapper,
        private ValidatorInterface $validator,
    ) {
    }

    /**
     * @param DevelopmentKitCreateDto $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): DevelopmentKitOutputDto
    {
        $entity = new DevelopmentKit($data->name);
        $entity->setType($data->type)
            ->setUntrackedDevelopments($data->untrackedDevelopments)
            ->setDevelopmentTimes($this->mapTimesDtoToEntity($data->developmentTimes))
        ;

        $this->validator->validate($entity);
        $this->developmentKitRepository->save($entity, true);

        return $this->developmentKitMapper->mapDevelopmentKitToOutputDto($entity);
    }

    private function mapTimesDtoToEntity(DevelopmentTimesDto $timesDto): DevelopmentKitTimes
    {
        return (new DevelopmentKitTimes())
            ->setFirstDeveloperTime($timesDto->firstDeveloperTime)
            ->setFirstDeveloperMultiplier($timesDto->firstDeveloperMultiplier)
            ->setReversalTime($timesDto->reversalTime)
            ->setReversalMultiplier($timesDto->reversalMultiplier)
            ->setColorDeveloperTime($timesDto->colorDeveloperTime)
            ->setColorDeveloperMultiplier($timesDto->colorDeveloperMultiplier)
            ->setPreBleachTime($timesDto->preBleachTime)
            ->setPreBleachMultiplier($timesDto->preBleachMultiplier)
            ->setBleachTime($timesDto->bleachTime)
            ->setBleachMultiplier($timesDto->bleachMultiplier)
            ->setFixerTime($timesDto->fixerTime)
            ->setFixerMultiplier($timesDto->fixerMultiplier)
            ->setClearingTime($timesDto->clearingTime)
            ->setClearingMultiplier($timesDto->clearingMultiplier)
            ->setSecondDeveloperTime($timesDto->secondDeveloperTime)
            ->setSecondDeveloperMultiplier($timesDto->secondDeveloperMultiplier)
        ;
    }
}
