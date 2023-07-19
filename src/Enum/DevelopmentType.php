<?php

declare(strict_types=1);

namespace App\Enum;

enum DevelopmentType: string
{
    case BW_NEGATIVE = 'bw_negative';
    case BW_POSITIVE = 'bw_positive';
    case COLOR_NEGATIVE = 'color_negative';
    case COLOR_POSITIVE = 'color_positive';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
