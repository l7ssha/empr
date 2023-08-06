<?php

declare(strict_types=1);

namespace App\State\Provider\Development\Developer;

use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\Development\Developer;
use App\Mapper\Development\DeveloperMapper;

readonly class DeveloperProvider implements ProviderInterface
{
    public function __construct(
        private ItemProvider $itemProvider,
        private DeveloperMapper $developerMapper,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        /** @var Developer|null $developer */
        $developer = $this->itemProvider->provide($operation, $uriVariables, $context);
        if ($developer === null) {
            return null;
        }

        return $this->developerMapper->mapDeveloperToOutputDto($developer);
    }
}
