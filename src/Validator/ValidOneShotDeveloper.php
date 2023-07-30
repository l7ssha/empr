<?php

declare(strict_types=1);

namespace App\Validator;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class ValidOneShotDeveloper extends Constraint
{
    public string $message = 'Given developer kit type requires not empty dilution field.';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
