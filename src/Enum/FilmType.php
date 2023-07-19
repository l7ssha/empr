<?php

declare(strict_types=1);

namespace App\Enum;

enum FilmType: string
{
    case BW = 'bw';
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
