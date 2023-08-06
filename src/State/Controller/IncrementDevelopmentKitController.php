<?php

declare(strict_types=1);

namespace App\State\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Entity\Development\DevelopmentKit;
use App\Repository\DevelopmentKitRepository;
use App\Service\DevelopmentCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class IncrementDevelopmentKitController extends AbstractController
{
    public function __construct(
        private readonly DevelopmentKitRepository $developmentKitRepository,
        private readonly ValidatorInterface $validator,
        private readonly DevelopmentCalculator $developmentTimesCalculator,
    ) {
    }

    public function __invoke(DevelopmentKit $kit): void
    {
        $this->developmentTimesCalculator->incrementUntrackedDevelopmentForDeveloperKit($kit);

        $this->validator->validate($kit);
        $this->developmentKitRepository->save($kit, true);
    }
}
