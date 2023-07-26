<?php

declare(strict_types=1);

namespace App\State\Provider\Development\DevelopmentKit;

use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\Development\DevelopmentKit;
use App\Mapper\Development\DevelopmentKitMapper;

readonly class DevelopmentKitProvider implements ProviderInterface
{
    public function __construct(
        private ItemProvider $itemProvider,
        private DevelopmentKitMapper $userDtoMapper,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        /** @var DevelopmentKit|null $kit */
        $kit = $this->itemProvider->provide($operation, $uriVariables, $context);
        if ($kit === null) {
            return null;
        }

        return $this->userDtoMapper->mapDevelopmentKitToOutputDto($kit);
    }
}
