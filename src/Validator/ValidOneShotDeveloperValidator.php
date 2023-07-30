<?php

declare(strict_types=1);

namespace App\Validator;

use App\Entity\Development\FilmDevelopment;
use App\Enum\DevelopmentType;
use RuntimeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidOneShotDeveloperValidator extends ConstraintValidator
{
    /**
     * @param FilmDevelopment $value
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof ValidDevelopmentTimes) {
            return;
        }

        if (!$value instanceof FilmDevelopment) {
            throw new RuntimeException(); // TODO: Message
        }

        if ($value->getKit()->getType() === DevelopmentType::BW_ONE_SHOT && $value->getDilution() === null) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ type }}', $value->getKit()->getType()->value)
                ->addViolation()
            ;
        }
    }
}
