<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Development\DevelopmentKit;

class DevelopmentCalculator
{
    public function calculateDevelopmentTime(float $baseTime, float $totalDevelopments, float $multiplierPerDevelopment): float
    {
        return $baseTime
            * (
                1 + (($totalDevelopments - 1) * $multiplierPerDevelopment)
            );
    }

    public function getTotalDevelopmentCount(DevelopmentKit $kit): int
    {
        return $kit->getUntrackedDevelopments() + $kit->getDevelopments()->count();
    }

    public function incrementUntrackedDevelopmentForDeveloperKit(DevelopmentKit $kit, int $toIncrement = 1): void
    {
        $kit->setUntrackedDevelopments($kit->getUntrackedDevelopments() + $toIncrement);
    }
}
