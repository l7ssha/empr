<?php

declare(strict_types=1);

namespace App\Validator;

use App\Dto\Development\DevelopmentKit\DevelopmentKitCreateDto;
use App\Dto\Development\DevelopmentKit\DevelopmentTimesDto;
use App\Enum\DevelopmentType;
use RuntimeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidDevelopmentTimesValidator extends ConstraintValidator
{
    /**
     * @param DevelopmentKitCreateDto $value
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof ValidDevelopmentTimes) {
            return;
        }

        if (!$value instanceof DevelopmentKitCreateDto) {
            throw new RuntimeException(); // TODO: Message
        }

        $valid = match ($value->type) {
            DevelopmentType::BW_NEGATIVE => $this->validateBwNegative($value->developmentTimes),
            DevelopmentType::BW_POSITIVE => $this->validateBwPositive($value->developmentTimes),
            DevelopmentType::COLOR_NEGATIVE => $this->validateColorNegative($value->developmentTimes),
            DevelopmentType::COLOR_POSITIVE => $this->validateColorPositive($value->developmentTimes),
        };

        if (!$valid) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ type }}', $value->type->value)
                ->addViolation()
            ;
        }
    }

    private function validateBwNegative(DevelopmentTimesDto $developmentTimes): bool
    {
        return
            $developmentTimes->firstDeveloperTime !== null
            && $developmentTimes->firstDeveloperMultiplier !== null
            && $developmentTimes->fixerTime !== null
            && $developmentTimes->fixerMultiplier !== null;
    }

    private function validateBwPositive(DevelopmentTimesDto $developmentTimes): bool
    {
        return
            $developmentTimes->firstDeveloperTime !== null
            && $developmentTimes->firstDeveloperMultiplier !== null
            && $developmentTimes->bleachTime !== null
            && $developmentTimes->bleachMultiplier !== null
            && $developmentTimes->clearingTime !== null
            && $developmentTimes->clearingMultiplier !== null
            && $developmentTimes->reversalTime !== null
            && $developmentTimes->reversalMultiplier !== null
            && $developmentTimes->secondDeveloperTime !== null
            && $developmentTimes->secondDeveloperMultiplier !== null
            && $developmentTimes->fixerTime !== null
            && $developmentTimes->fixerMultiplier !== null;
    }

    private function validateColorNegative(DevelopmentTimesDto $developmentTimes): bool
    {
        return $developmentTimes->colorDeveloperTime !== null
            && $developmentTimes->colorDeveloperMultiplier != null
            && (
                ($developmentTimes->blixTime !== null && $developmentTimes->blixMultiplier !== null)
                || ($developmentTimes->bleachTime !== null && $developmentTimes->bleachMultiplier !== null
                    && $developmentTimes->fixerTime !== null
                    && $developmentTimes->fixerMultiplier !== null
                )
            );
    }

    private function validateColorPositive(DevelopmentTimesDto $developmentTimes): bool
    {
        return $this->validateBwNegative($developmentTimes)
            && $developmentTimes->firstDeveloperTime !== null
            && $developmentTimes->firstDeveloperMultiplier !== null
            && $developmentTimes->reversalTime !== null
            && $developmentTimes->reversalMultiplier !== null
            && $developmentTimes->preBleachTime !== null
            && $developmentTimes->preBleachMultiplier !== null
        ;
    }
}
