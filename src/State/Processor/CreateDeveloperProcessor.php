<?php

declare(strict_types=1);

namespace App\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Validator\ValidatorInterface;
use App\Dto\Development\Developer\CreateDeveloperInputDto;
use App\Dto\Development\Developer\DeveloperOutputDto;
use App\Entity\Development\Developer;
use App\Mapper\Development\DeveloperMapper;
use App\Repository\DeveloperRepository;

readonly class CreateDeveloperProcessor implements ProcessorInterface
{
    public function __construct(
        private DeveloperRepository $developerRepository,
        private DeveloperMapper $developerMapper,
        private ValidatorInterface $validator,
    ) {
    }

    /**
     * @param CreateDeveloperInputDto $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): DeveloperOutputDto
    {
        $developer = (new Developer())
            ->setName($data->name)
            ->setOriginalVolume($data->originalVolume)
        ;

        $this->validator->validate($developer);
        $this->developerRepository->save($developer, true);

        return $this->developerMapper->mapDeveloperToOutputDto($developer);
    }
}
