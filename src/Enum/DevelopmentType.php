<?php

declare(strict_types=1);

namespace App\Enum;

enum DevelopmentType: string
{
    case BW_NEGATIVE = 'bw_negative';
    case BW_POSITIVE = 'bw_positive';
    case BW_ONE_SHOT = 'bw_one_shot';
    case COLOR_NEGATIVE_3STEP = 'color_negative_3step';
    case COLOR_NEGATIVE_2STEP = 'color_negative_2step';
    case COLOR_POSITIVE_3STEP = 'color_positive_3step';
    case COLOR_POSITIVE_6STEP = 'color_positive_6step';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
