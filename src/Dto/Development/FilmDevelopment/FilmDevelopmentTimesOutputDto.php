<?php

declare(strict_types=1);

namespace App\Dto\Development\FilmDevelopment;

class FilmDevelopmentTimesOutputDto
{
    public ?float $firstDeveloperTime = null;
    public ?float $reversalTime = null;
    public ?float $colorDeveloperTime = null;
    public ?float $preBleachTime = null;
    public ?float $bleachTime = null;
    public ?float $blixTime = null;
    public ?float $fixerTime = null;
    public ?float $clearingTime = null;
    public ?float $secondDeveloperTime = null;
}
