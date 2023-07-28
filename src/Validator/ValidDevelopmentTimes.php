<?php

declare(strict_types=1);

namespace App\Validator;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class ValidDevelopmentTimes extends Constraint
{
    public string $message = "Given development times are not valid for given development kit type: '{{ type }}'";

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
